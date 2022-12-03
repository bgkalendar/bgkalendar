
function LetoGregorianMonth(/*LetoPeriodStructureBean*/ bean, /*LocaleStringId*/ translatedName) {
    this.mBean = bean;                         // LetoPeriodStructureBean
    this.mNameTranslationId = translatedName;  // LocaleStringId

    this.mPeriodType = null;                   // LetoPeriodType 
    this.mTotalLengthInPeriodTypes = null;     // Map<LetoPeriodType, Long> mTotalLengthInPeriodTypes
    

    this.getPeriodType = function () {
        if (mPeriodType == null) {
            return mBean.getPeriodType();
        } else {
            return mPeriodType;
        }
    }

    this.setPeriodType = function (period) {
        mPeriodType = period;
    }

    this.getTotalLengthInDays = function () {
        return mBean.getTotalLengthInDays();
    }

    this.getSubPeriods = function () {
        return mBean.getSubPeriods();
    }
    
    this.setTotalLengthInPeriodTypes = function (lengthsInPeriodTypes) {
        mTotalLengthInPeriodTypes = lengthsInPeriodTypes;
    }

    this.getTotalLengthInPeriodTypes = function (periodType) {
        if (periodType == getPeriodType()) {
            return 1;
        }
        if (mTotalLengthInPeriodTypes == null) {
            mBean.getTotalLengthInPeriodTypes(periodType);
        }
        var countLong = mTotalLengthInPeriodTypes.get(periodType);
        if (countLong == null) {
            mBean.getTotalLengthInPeriodTypes(periodType);
        }
        return countLong.longValue();
    }
    
    this.getName = function (locale) {
        if (locale == null) {
           locale = "en";
        } 
        return LocaleStrings.get(mNameTranslationId, locale, mBean.getName(locale));
    }

    this.getNameTranslations = function () {
        var translations = LocaleStrings.get(mNameTranslationId);
        return translations;
    }

}

if (module != null && module.exports != null)  {
  module.exports = LetoGregorianMonth
}

