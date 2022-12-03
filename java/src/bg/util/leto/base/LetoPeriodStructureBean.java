package bg.util.leto.base;

import java.util.Locale;
import java.util.Map;

import bg.util.leto.api.LetoExceptionUnrecoverable;
import bg.util.leto.api.LetoPeriodType;
import bg.util.leto.impl.LocaleStringId;
import bg.util.leto.impl.LocaleStrings;
import bg.util.leto.api.LetoPeriodStructure;

public class LetoPeriodStructureBean implements LetoPeriodStructure {

    private LocaleStringId mNameTranslationIndex = null;
    private LetoPeriodStructure[] mSubPeriods = null;
    private LetoPeriodType mPeriodType = null;
    private long mTotalLengthInDays = 0;
    private Map<LetoPeriodType, Long> mTotalLengthInPeriodTyps = null;
    
    
    public LetoPeriodStructureBean(LocaleStringId translatedName, long totalLengthInDays, LetoPeriodStructure[] subPeriods) 
    {
        mNameTranslationIndex = translatedName;
        mSubPeriods = subPeriods;
        mTotalLengthInDays = totalLengthInDays;
    }
    
    
    
    @Override
    public LetoPeriodType getPeriodType() {
        return mPeriodType;
    }
    
    @Override
    public void setPeriodType(LetoPeriodType period) throws LetoExceptionUnrecoverable {
        if (mPeriodType != null && period != null) {
            throw new LetoExceptionUnrecoverable("Period Type for " + mTotalLengthInDays + " day period is already set to \"" 
                  + period.getName(LocaleStrings.ENGLISH) + "\". Cannot reset it to \"" + period.getName(LocaleStrings.ENGLISH) 
                  + "\".");
        }
        mPeriodType = period;
    }
    
    public void setSubPeriods(LetoPeriodStructure[] subPeriods) {
        mSubPeriods = subPeriods;
    }
    
    @Override
    public LetoPeriodStructure[] getSubPeriods() {
        return mSubPeriods;
    }

    public void setTotalLengthInDays(long lengthInDays) {
        mTotalLengthInDays = lengthInDays;
    }
    
    public void setTotalLengthInPeriodTypes(Map<LetoPeriodType, Long> lengthsInPeriodTypes) {
        mTotalLengthInPeriodTyps = lengthsInPeriodTypes;
    }
    
    @Override
    public long getTotalLengthInDays() {
         return mTotalLengthInDays;
    }

    @Override
    public long getTotalLengthInPeriodTypes(LetoPeriodType periodType) {
        if (periodType == getPeriodType()) {
            return 1;
        }
        if (mTotalLengthInPeriodTyps == null) {
            return 0;
        }
        Long countLong = mTotalLengthInPeriodTyps.get(periodType);
        if (countLong == null) {
            return 0;
        }
        return countLong.longValue();
    }
    
    @Override
    public String toString() {
        return getPeriodType() + " of " + getTotalLengthInDays() + " days";
    }
    
    @Override
    public String getName() {
        return getName(Locale.ENGLISH);
    }
    
    @Override
    public String getName(Locale locale) {
        return LocaleStrings.get(mNameTranslationIndex, locale, getPeriodType() == null ? null : getPeriodType().getName(locale));
    }
    
    @Override
    public Map<Locale, String> getNameTranslations() {
        Map<Locale, String> translations = LocaleStrings.get(mNameTranslationIndex);
        return translations;
    }

}
