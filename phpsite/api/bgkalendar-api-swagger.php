<?php 
require_once(dirname(__DIR__) .'/includes.php');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, api_key, Authorization");

$ssl      = ( ! empty( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] == 'on' );
$s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
$protocol = substr(strtolower($_SERVER["SERVER_PROTOCOL"]), 0, strpos(strtolower($_SERVER["SERVER_PROTOCOL"]), "/")) . $s;
$port     = $_SERVER['SERVER_PORT'];
$port     = ( ( ! $ssl && $port=='80' ) || ( $ssl && $port=='443' ) ) ? '' : ':'.$port;
$len = strlen(realpath($_SERVER["DOCUMENT_ROOT"]));
$dir = realpath(__DIR__);
$uri = substr($dir, $len);
$server = $_SERVER['SERVER_NAME'];
$fullurl = $protocol . "://" . $server . $port . $uri;

?>
{
    "swagger": "2.0",
    "info": {
        "description": "<?php tr('Интерфейс за разработване на приложения (REST API), който ви дава възможност за превръщане на дата от Древния Български Календар към Съвременния Григориански каленар и обратно, както и изчисляване на текущиат ден по един от двата календара.', 
                                 'Application Programming Interface (API) that allows calculation of dates in the Ancient Bulgarian Calendar or the Modern Gregoria/Julian Calendar also conversion of a date from one calendar to the other.', 
                                 'Application Development Interface (REST API), mit dem Sie ein Datum aus dem alten bulgarischen Kalender in den modernen Gregorianischen Kalender umwandeln können und umgekehrt, sowie den aktuellen Tag auf einem der beiden Kalender berechnen können.', 
                                 'Интерфейс разработки приложений (REST API), который позволяет конвертировать дату из древнего болгарского календаря в современный григорианский календарь и наоборот, а также рассчитать текущий день на одном из двух календарей.');?>",
        "version": "0.1.0",
        "title": "<?php tr('Проект Българският Календар - REST API', 'Project Bulgarian Calendar - REST API', 'Projekt bulgarischer Kalender - REST API', 'Проект Болгарский календарь - REST API')?>",
        "termsOfService": "http://swagger.io/terms/",
        "contact": {
            "email": "yordan.nedelchev@hotmail.com"
        },
        "license": {
            "name": "Custom License",
            "url": "https://opensource.org/licenses/MIT"
        }
    },
    "host": "<?php echo $server; ?>",
    "basePath": "<?php echo $uri;?>/v0/calendars",
    "tags": [
       {
        "name": "bulgarian",
        "description": "<?php tr('Операции с Древният Български Календар', 
                                 'Work with Ancient Bulgarian Calendar', 
                                 'Operationen mit dem alten bulgarischen Kalender', 
                                 'Операции с древним болгарским календарем');?>"
       },
       {
        "name": "gregorian",
        "description": "<?php tr('Операции със Съвременния Григориански Календар', 
                                 'Work with Modern Gregorian Calendar', 
                                 'Operationen mit dem modernen Gregorianischen Kalender', 
                                 'Операции с современным григорианскому календарем');?>"
       }
    ],
    "schemes": [
        "<?php echo $protocol;?>"
    ],
    "paths": {
        "/bulgarian/dates/today": {
            "get": {
                "tags": ["bulgarian"],
                "summary": "<?php tr('Вземане на текущата дата по Древния Български Календар, изчисляване на съответните периоди и превръщането на датата в дата от Григорианския календар', 
                                     'Get current date in Ancient Bulgarian Calendar and convert it to the MOdern Gregorian Calendar', 
                                     'Nehmen Sie das aktuelle Datum im antiken bulgarischen Kalender, berechnen Sie die relevanten Zeiträume und verwandeln Sie das Datum in ein Datum aus dem Gregorianischen Kalender', 
                                     'Возьмите текущую дату в древнеболгарском календаре, вычислите соответствующие периоды и превратите дату в дату из григорианского календаря');?>",
                "description": "<?php tr('Вземане на текущата дата по Древния Български Календар.', 
                                         'Get current date of today in the Ancient Bulgarian Calendar.', 
                                         'Das aktuelle Datum im alten bulgarischen Kalender', 
                                         'Принимание текущую дату в древнем болгарском календаре');?>",
                "produces": ["application/json"],
                "responses": {
                  "200": {
                    "description": "OK", 
                    "content": {
                      "schema": {
                         "type": "object"
                      }
                    }
                  }
                }
            }
        },
        "/bulgarian/model": {
            "get": {
                "tags": ["bulgarian"],
                "summary": "<?php tr('Структура на периодите в Древния Български Календар', 
                                     'Describes the structure of the Ancient Bulgarian Calendar.', 
                                     'Struktur der Epochen im alten bulgarischen Kalender', 
                                     'Структура периодов в древнем болгарском календаре');?>",
                "description": "<?php tr('Структура на периодите в Древния Български Календар', 
                                     'Model of Ancient Bulgarian Calendar',
                                     'Struktur der Epochen im alten bulgarischen Kalender', 
                                     'Структура периодов в древнем болгарском календаре');?>",
                "produces": ["application/json"],
                "responses": {
                  "200": {
                    "description": "OK", 
                    "content": {
                      "schema": {
                         "type": "object"
                      }
                    }
                  }
                }
            }
        },
        "/gregorian/dates/today": {
            "get": {
                "tags": ["gregorian"],
                "summary": "<?php tr('Вземане на текущата дата по Съвременния Григориански Календар, изчисляване на съответните периоди и превръщането на датата в дата от Древния Български Календар', 
                                     'Get current date in Modern Gregorian Calendar and converts it into the corresponding date in the Ancient Bulgarian Calendar', 
                                     'Nehmen Sie das aktuelle Datum im modernen Gregorianischen Kalender, die Berechnung der entsprechenden Zeiträume und die Umwandlung des Datums in ein Datum aus dem alten bulgarischen Kalender', 
                                     'Принимая текущую дату в современном григорианский календарь, расчет соответствующих периодов и преобразования даты в дату из древнего болгарского календаря');?>",
                "description": "<?php tr('Вземане на текущата дата по Съвременния Григориански Календар.', 
                                         'Get current date of today in the Modern Gregorian Calendar.', 
                                         'Das aktuelle Datum im modernen Gregorianischen Kalender.', 
                                         'Создание текущей даты в современном григорианский календарь.');?>",
                "produces": ["application/json"],
                "responses": {
                  "200": {
                    "description": "OK", 
                    "content": {
                      "schema": {
                         "type": "object"
                      }
                    }
                  }
                }
            }
        },
        "/gregorian/model": {
            "get": {
                "tags": ["gregorian"],
                "summary": "<?php tr('Структура на периодите в Съвременния Григориански Календар.', 
                                     'Describes the structure of the Modern Gregorian Calendar.', 
                                     'Struktur der Epochen im modernen Gregorianischen Kalender.', 
                                     'Структура периодов в современном григорианскому календаре.');?>",
                "description": "<?php tr('Структура на периодите в Съвременния Григориански Календар.', 
                                     'Model of Greforian Calendar',
                                     'Struktur der Epochen im modernen Gregorianischen Kalender.', 
                                     'Структура периодов в современном григорианскому календаре.');?>",
                "produces": ["application/json"],
                "responses": {
                  "200": {
                    "description": "OK", 
                    "content": {
                      "schema": {
                         "type": "object"
                      }
                    }
                  }
                }
            }
        }
    }
}
