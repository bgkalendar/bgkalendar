if (require != null) {
 var LocaleStrings = require("./LocaleStrings.js");
}

function LocaleStringId(id, defaultValueIfNotFound, translations) {
  this.mValue = id;
  this.mDefaultValue = defaultValueIfNotFound;
  if (translations != null) { 
    LocaleStrings.addTranslations(this, translations);
  }

  
  this.getId = function () {
      return this.mValue;
  }
  
  this.getDefaultValue = function () {
      return this.mDefaultValue;
  }
}

if (module != null && module.exports != null)  {
  module.exports = LocaleStringId
}

