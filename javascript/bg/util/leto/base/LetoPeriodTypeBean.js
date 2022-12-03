if (require != null) {
 var LocaleStrings           = require("../impl/LocaleStrings.js");
}

function LetoPeriodTypeBean(nameTranslationIndex, descriptionTranslationIndex, structures) {

    this.mNameTranslationIndex = nameTranslationIndex;
    
    this.mDescriptionTranslationIndex = descriptionTranslationIndex;
    
    this.mPossibleStructures = structures;
    

    this.setName = function (nameTranslationIndex)  {
        setDescription(descriptionTranslationIndex);
        setPossibleStructures(structures);
        if (structures != null) {
            for (var i = 0; i < structures.length; i++) {
                structures[i].setPeriodType(this);             // Can throw LetoException 
            }
        }
    }

    this.setDescription = function (descriptionTranslationIndex) {
        mDescriptionTranslationIndex = descriptionTranslationIndex;
    }
    
    this.setName = function (nameTranslationIndex) {
        mNameTranslationIndex = nameTranslationIndex;
    }
    
    this.getName = function () {
        return getName(Locale.ENGLISH);
    }
    
    this.getName = function(locale) {
        return LocaleStrings.get(this.mNameTranslationIndex, locale, null);
    }

    this.getDescription = function (locale) {
        if (locale == null) {
          locale = "en";
        } 
        return LocaleStrings.get(this.mDescriptionTranslationIndex, locale, null);
    }
    
    this.getNameTranslations = function () {
        var translations = LocaleStrings.get(mNameTranslationIndex);
        return translations;
    }
    
    this.getDescriptionTranslations = function () {
        this.translations = LocaleStrings.get(mDescriptionTranslationIndex);
        return translations;
    }

    this.setPossibleStructures = function (structures) {
        mPossibleStructures = structures;
    }
    
    this.getPossibleStructures = function () {
        return mPossibleStructures;
    }
    
    this.toString = function () {
        return this.getName("en");
    }

}

if (module != null && module.exports != null)  {
  module.exports = LetoPeriodTypeBean
}


