package bg.util.leto.impl.gregorian;

import java.util.Locale;
import java.util.Map;

import bg.util.leto.api.LetoExceptionUnrecoverable;
import bg.util.leto.api.LetoPeriodStructure;
import bg.util.leto.api.LetoPeriodType;
import bg.util.leto.base.LetoPeriodStructureBean;
import bg.util.leto.impl.LocaleStringId;
import bg.util.leto.impl.LocaleStrings;

public class LetoGregorianMonth implements LetoPeriodStructure {
    
    
    private LetoPeriodStructureBean mBean = null;
    private LocaleStringId mNameTranslationId = null;
    private LetoPeriodType mPeriodType = null;
    private Map<LetoPeriodType, Long> mTotalLengthInPeriodTypes = null;
    
    public LetoGregorianMonth(LetoPeriodStructureBean bean, LocaleStringId translatedName) {
        mBean = bean;
        mNameTranslationId = translatedName;
    }

    @Override
    public LetoPeriodType getPeriodType() {
        if (mPeriodType == null) {
            return mBean.getPeriodType();
        } else {
            return mPeriodType;
        }
    }

    @Override
    public void setPeriodType(LetoPeriodType period) throws LetoExceptionUnrecoverable {
        mPeriodType = period;
    }

    @Override
    public long getTotalLengthInDays() {
        return mBean.getTotalLengthInDays();
    }

    @Override
    public LetoPeriodStructure[] getSubPeriods() {
        return mBean.getSubPeriods();
    }
    
    public void setTotalLengthInPeriodTypes(Map<LetoPeriodType, Long> lengthsInPeriodTypes) {
        mTotalLengthInPeriodTypes = lengthsInPeriodTypes;
    }

    @Override
    public long getTotalLengthInPeriodTypes(LetoPeriodType periodType) {
        if (periodType == getPeriodType()) {
            return 1;
        }
        if (mTotalLengthInPeriodTypes == null) {
            mBean.getTotalLengthInPeriodTypes(periodType);
        }
        Long countLong = mTotalLengthInPeriodTypes.get(periodType);
        if (countLong == null) {
            mBean.getTotalLengthInPeriodTypes(periodType);
        }
        return countLong.longValue();
    }

    @Override
    public String getName() {
        return getName(Locale.ENGLISH);
    }
    
    @Override
    public String getName(Locale locale) {
        return LocaleStrings.get(mNameTranslationId, locale, mBean.getName(locale));
    }

    @Override
    public Map<Locale, String> getNameTranslations() {
        Map<Locale, String> translations = LocaleStrings.get(mNameTranslationId);
        return translations;
    }

}
