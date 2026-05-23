#!/bin/bash
set -euo pipefail

if [[ -f .custom_config ]]; then
  # shellcheck disable=SC1091
  . ./.custom_config
fi

display_usage() {
  echo "Start application containers"
  echo "Support: KhnTzar <ivasgo@gmail.com>"
  echo
  echo "Options:"
  echo "-h|--help               Print this help"
  echo "-r|--recreate           Recreate containers"
  echo "-b|--build              Build image"
  echo "-n|--build-no-cache     Build image"
  echo "-J|--with-javadoc       Build image including generated JavaDoc"
  echo "-d|--down               Down containers"
  echo "-u|--up                 Up containers"
  echo "-t|--test               Run unit tests"
  echo
}

# Convert long options to short options.
for arg in "$@"; do
  shift
  case "$arg" in
    --help) set -- "$@" -h ;;
    --recreate) set -- "$@" -r ;;
    --build) set -- "$@" -b ;;
    --build-no-cache) set -- "$@" -n ;;
    --with-javadoc) set -- "$@" -J ;;
    --down) set -- "$@" -d ;;
    --up) set -- "$@" -u ;;
    --test) set -- "$@" -t ;;
    *) set -- "$@" "$arg" ;;
  esac
done

if [[ $# -eq 0 ]]; then
  display_usage
  exit 0
fi

RECREATE=false
DO_BUILD=false
DO_BUILD_NO_CACHE=false
DO_DOWN=false
DO_UP=false
DO_TEST=false
BUILD_TARGET_OVERRIDE=""

while getopts "hrbndutJ" option; do
  case "${option}" in
    r) RECREATE=true ;;
    b) DO_BUILD=true ;;
    n) DO_BUILD_NO_CACHE=true ;;
    J) BUILD_TARGET_OVERRIDE="runtime_with_javadoc" ;;
    d) DO_DOWN=true ;;
    u) DO_UP=true ;;
    t) DO_TEST=true ;;
    h)
      display_usage
      exit 0
      ;;
    *)
      display_usage
      exit 1
      ;;
  esac
done

ENVFILE=".env"
if [[ -f "${ENVFILE}" ]]; then
  # shellcheck disable=SC1090
  . "./${ENVFILE}"
elif [[ -f ".env_default" ]]; then
  cp .env_default "${ENVFILE}"
  # shellcheck disable=SC1090
  . "./${ENVFILE}"
fi

DOCKER_COMPOSE_FILE="${DOCKER_COMPOSE_FILE:-docker-compose.yml}"
if [[ ! -f "${DOCKER_COMPOSE_FILE}" ]]; then
  echo "Could not find ${DOCKER_COMPOSE_FILE} configuration file"
  exit 1
fi

# Prefer git tag for image tagging; fallback to latest.
if [[ -z "${IMAGE_TAG:-}" ]]; then
  IMAGE_TAG="$(git describe --tags --exact-match 2>/dev/null || git describe --tags --abbrev=0 2>/dev/null || echo latest)"
fi

# Auto-detect platform/dockerfile when not explicitly configured.
if [[ -z "${PLATFORM:-}" || -z "${DOCKERFILE:-}" ]]; then
  ARCH="$(uname -m)"
  case "${ARCH}" in
    x86_64)
      : "${PLATFORM:=linux/amd64}"
      : "${DOCKERFILE:=Dockerfile}"
      ;;
    aarch64|arm64)
      : "${PLATFORM:=linux/arm64}"
      : "${DOCKERFILE:=Dockerfile.arm64}"
      ;;
    *)
      : "${PLATFORM:=linux/amd64}"
      : "${DOCKERFILE:=Dockerfile}"
      ;;
  esac
fi

compose_build() {
  local build_args=("$@")

  if docker compose -f "${DOCKER_COMPOSE_FILE}" build "${build_args[@]}"; then
    return 0
  fi

  echo
  echo "Build with BuildKit/buildx failed, retrying with classic builder..."
  DOCKER_BUILDKIT=0 COMPOSE_DOCKER_CLI_BUILD=0 \
    docker compose -f "${DOCKER_COMPOSE_FILE}" build "${build_args[@]}"
}

wait_for_http_ready() {
  local url="$1"
  local retries="${2:-30}"
  local delay="${3:-1}"
  local attempt=1

  while [[ "${attempt}" -le "${retries}" ]]; do
    if curl -fsS --max-time 3 "${url}" >/dev/null 2>&1; then
      echo "HTTP ready: ${url}"
      return 0
    fi
    sleep "${delay}"
    attempt=$((attempt + 1))
  done

  echo "Timed out waiting for HTTP readiness at ${url}" >&2
  return 1
}

if [[ "${RECREATE}" == "true" ]]; then
  DO_DOWN=true
  DO_BUILD=true
  DO_UP=true
fi

# --build-no-cache implies build
if [[ "${DO_BUILD_NO_CACHE}" == "true" ]]; then
  DO_BUILD=true
fi

# Default behavior when no action flags are passed.
if [[ "${DO_DOWN}" == "false" && "${DO_BUILD}" == "false" && "${DO_UP}" == "false" && "${DO_TEST}" == "false" ]]; then
  DO_BUILD=true
  DO_UP=true
fi

if [[ "${DO_DOWN}" == "true" ]]; then
  echo "docker compose -f ${DOCKER_COMPOSE_FILE} down"
  docker compose -f "${DOCKER_COMPOSE_FILE}" down
fi

if [[ "${DO_BUILD}" == "true" ]]; then
  echo
  BUILD_TARGET="${BUILD_TARGET_OVERRIDE:-${BUILD_TARGET:-runtime_no_javadoc}}"
  if [[ "${DO_BUILD_NO_CACHE}" == "true" ]]; then
    echo "IMAGE_TAG=${IMAGE_TAG} BUILD_TARGET=${BUILD_TARGET} docker compose -f ${DOCKER_COMPOSE_FILE} build --force-rm --no-cache"
    IMAGE_TAG="${IMAGE_TAG}" BUILD_TARGET="${BUILD_TARGET}" compose_build --force-rm --no-cache
  else
    echo "IMAGE_TAG=${IMAGE_TAG} BUILD_TARGET=${BUILD_TARGET} docker compose -f ${DOCKER_COMPOSE_FILE} build --force-rm"
    IMAGE_TAG="${IMAGE_TAG}" BUILD_TARGET="${BUILD_TARGET}" compose_build --force-rm
  fi
fi

if [[ "${DO_UP}" == "true" ]]; then
  echo
  if [[ "${DO_BUILD}" == "true" ]]; then
    echo "IMAGE_TAG=${IMAGE_TAG} docker compose -f ${DOCKER_COMPOSE_FILE} up --no-build --detach"
    IMAGE_TAG="${IMAGE_TAG}" docker compose -f "${DOCKER_COMPOSE_FILE}" up --no-build --detach
  else
    echo "IMAGE_TAG=${IMAGE_TAG} docker compose -f ${DOCKER_COMPOSE_FILE} up --detach"
    IMAGE_TAG="${IMAGE_TAG}" docker compose -f "${DOCKER_COMPOSE_FILE}" up --detach
  fi

  echo
  echo "Container running on: $(hostname)"
fi

if [[ "${DO_TEST}" == "true" ]]; then
  echo
  echo "Starting PHP tests..."
  echo
  echo "docker compose -f ${DOCKER_COMPOSE_FILE} run --rm --no-deps --entrypoint sh -v \$PWD/phpsite/tests:/app/public/tests bgkalendar -lc 'set -e; /app/public/tests/environment_runtime_test.sh; if command -v java >/dev/null 2>&1; then java -version; else echo \"java: not installed in runtime image\"; fi; for test_file in /app/public/tests/*_test.php; do php \"\$test_file\"; done'"
  docker compose -f "${DOCKER_COMPOSE_FILE}" run --rm --no-deps --entrypoint sh \
    -v "$PWD/phpsite/tests:/app/public/tests" \
    bgkalendar -lc 'set -e; /app/public/tests/environment_runtime_test.sh; if command -v java >/dev/null 2>&1; then java -version; else echo "java: not installed in runtime image"; fi; for test_file in /app/public/tests/*_test.php; do php "$test_file"; done'

  echo
  echo "docker compose -f ${DOCKER_COMPOSE_FILE} up -d --no-build bgkalendar"
  docker compose -f "${DOCKER_COMPOSE_FILE}" up -d --no-build bgkalendar

  TEST_PORT="${PORT_NUMBER:-8387}"
  echo "Waiting for local HTTP readiness on port ${TEST_PORT}..."
  wait_for_http_ready "http://localhost:${TEST_PORT}/api/v0/calendars/bulgarian/dates/today/" 60 1

  echo "./phpsite/tests/rest_bulgarian_today_http_test.sh ${TEST_PORT}"
  ./phpsite/tests/rest_bulgarian_today_http_test.sh "${TEST_PORT}"
  echo "./phpsite/tests/rest_bulgarian_model_http_test.sh ${TEST_PORT}"
  ./phpsite/tests/rest_bulgarian_model_http_test.sh "${TEST_PORT}"
  echo "./phpsite/tests/rest_gregorian_today_http_test.sh ${TEST_PORT}"
  ./phpsite/tests/rest_gregorian_today_http_test.sh "${TEST_PORT}"
  echo "./phpsite/tests/rest_gregorian_model_http_test.sh ${TEST_PORT}"
  ./phpsite/tests/rest_gregorian_model_http_test.sh "${TEST_PORT}"
  PUBLIC_BASE_URL="${PUBLIC_BASE_URL:-http://130.61.239.255:8387}"
  echo "./phpsite/tests/page_javadoc_http_test.sh ${PUBLIC_BASE_URL}/javadoc/"
  ./phpsite/tests/page_javadoc_http_test.sh "${PUBLIC_BASE_URL}/javadoc/"
  echo "./phpsite/tests/page_kupulica_bg_http_test.sh ${PUBLIC_BASE_URL}/kupu%D0%BBu%D1%86a-bg.php"
  ./phpsite/tests/page_kupulica_bg_http_test.sh "${PUBLIC_BASE_URL}/kupu%D0%BBu%D1%86a-bg.php"
  echo "./phpsite/tests/page_papercalendar_2017_http_test.sh ${PUBLIC_BASE_URL}/papercalendar/2017/index.php?lang=bg"
  ./phpsite/tests/page_papercalendar_2017_http_test.sh "${PUBLIC_BASE_URL}/papercalendar/2017/index.php?lang=bg"

  echo
  echo "Starting Java tests..."
  echo
  echo "docker run --rm -v \$PWD/java:/work -v \$HOME/.gradle:/root/.gradle -w /work eclipse-temurin:21-jdk bash -lc './gradlew --no-daemon compileJava test && javap -classpath build/classes/java/main bg.util.leto.api.Leto bg.util.leto.base.LetoBase bg.util.leto.impl.LocaleStrings bg.util.leto.impl.bulgarian.LetoBulgarian bg.util.leto.impl.generic.LetoGeneric bg.util.leto.impl.gregorian.LetoGregorian bg.util.leto.impl.julian.LetoJulian >/dev/null && echo \"Java package check passed: bg.util.leto.api, bg.util.leto.base, bg.util.leto.impl, bg.util.leto.impl.bulgarian, bg.util.leto.impl.generic, bg.util.leto.impl.gregorian, bg.util.leto.impl.julian\"'"
  docker run --rm \
    -v "$PWD/java:/work" \
    -v "$HOME/.gradle:/root/.gradle" \
    -w /work \
    eclipse-temurin:21-jdk \
    bash -lc './gradlew --no-daemon compileJava test && javap -classpath build/classes/java/main bg.util.leto.api.Leto bg.util.leto.base.LetoBase bg.util.leto.impl.LocaleStrings bg.util.leto.impl.bulgarian.LetoBulgarian bg.util.leto.impl.generic.LetoGeneric bg.util.leto.impl.gregorian.LetoGregorian bg.util.leto.impl.julian.LetoJulian >/dev/null && echo "Java package check passed: bg.util.leto.api, bg.util.leto.base, bg.util.leto.impl, bg.util.leto.impl.bulgarian, bg.util.leto.impl.generic, bg.util.leto.impl.gregorian, bg.util.leto.impl.julian"'
fi
