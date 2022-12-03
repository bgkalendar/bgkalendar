
#include "stdafx.h"
#include "Language.h"

LANG getLang() {
	LANGID langid = GetUserDefaultUILanguage();
	LANGID lang = langid & 0x1F;
	switch (lang) {
	  case LANG_BULGARIAN: return BG;
	  case LANG_ENGLISH:   return EN;
	  case LANG_GERMAN:    return DE;
	  case LANG_RUSSIAN:   return RU;
	  default:
		return LANG::EN;
	}
}

char* tr(char* bg, char* en, char* de, char* ru) {
	LANG lang = getLang();
	switch (lang) {
	  case BG: return bg;
	  case EN: return en;
	  case DE: return de;
	  case RU: return ru;
	   default: return en;
	}
}


