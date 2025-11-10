#!/bin/bash
set -euo pipefail

# --- Help ---
usage() {
  cat <<'EOF'
Usage: docker-build-publish.sh [options]

Options:
  -p, --publish       Tag & push image (:latest and :YYYY-MM-DD) to Docker Hub
  -P, --port PORT     Host port -> container 80 (default: 80)
  -h, --help          Show this help and exit

Behavior:
  * Always builds & starts via docker compose
    using the right Dockerfile for your architecture (x86_64 / arm64).
  * With -p, it pushes both :latest and :YYYY-MM-DD tags to Docker Hub.

Examples:
  ./docker-build-publish.sh
  ./docker-build-publish.sh -P 8089
  ./docker-build-publish.sh -p
EOF
}

# --- Show help if no args ---
[[ $# -eq 0 ]] && { usage; exit 0; }

# --- Defaults ---
ARCH="$(uname -m)"
case "$ARCH" in
  x86_64)        DF="Dockerfile";       PLATFORM="linux/amd64" ;;
  aarch64|arm64) DF="Dockerfile.arm64"; PLATFORM="linux/arm64" ;;
  *) echo "Unsupported architecture: $ARCH" >&2; exit 1 ;;
esac

REPO="bgkalendar/bgkalendar"
TAG="$(date +%F)"
DOCKERHUB_USER="${DOCKERHUB_USER:-bgkalendar}"
PORT=80
CONTAINER_NAME="bgkalendar"

DO_PUBLISH=0

# --- Parse args ---
while [[ $# -gt 0 ]]; do
  case "$1" in
    -p|--publish) DO_PUBLISH=1; shift ;;
    -P|--port)    PORT="${2:-}"; shift 2 ;;
    -h|--help)    usage; exit 0 ;;
    *) echo "Unknown option: $1" >&2; usage; exit 1 ;;
  esac
done

# --- Compose build & run ---
echo "Building & starting via docker compose (ARCH=$ARCH, PORT=$PORT)"

# Stop/remove existing container if it exists
if docker ps -a --format '{{.Names}}' | grep -q "^${CONTAINER_NAME}\$"; then
  echo "Existing container '$CONTAINER_NAME' detected — stopping and removing..."
  docker stop "$CONTAINER_NAME" >/dev/null 2>&1 || true
  docker rm   "$CONTAINER_NAME" >/dev/null 2>&1 || true
fi

# Compose build + recreate
DOCKERFILE="$DF" PLATFORM="$PLATFORM" PORT_NUMBER="$PORT" \
  docker compose up -d --build --force-recreate

# --- Publish (optional) ---
if [[ "$DO_PUBLISH" -eq 1 ]]; then
  echo "Preparing to push image to Docker Hub..."
  docker login --username="$DOCKERHUB_USER"
  docker tag "$REPO:latest" "$REPO:$TAG"
  docker push "$REPO:latest"
  docker push "$REPO:$TAG"
  echo "Pushed: $REPO:latest and $REPO:$TAG"
fi

# --- Hints ---
echo
echo "Manual compose example:"
echo "  DOCKERFILE=$DF PLATFORM=$PLATFORM PORT_NUMBER=$PORT docker compose up -d --build --force-recreate"
echo
echo "To stop:"
echo "  docker compose down"
