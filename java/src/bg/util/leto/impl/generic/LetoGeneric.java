package bg.util.leto.impl.generic;

import java.util.Locale;
import java.util.Map;

import bg.util.leto.api.LetoPeriodType;
import bg.util.leto.base.LetoBase;
import bg.util.leto.impl.LocaleStringId;

public class LetoGeneric extends LetoBase {

    private String mName = null;
    private String mDescription = null;
    private LocaleStringId mNameTranslationIndex = null;
    private LocaleStringId mDescriptionTranslationIndex = null;
    
    public LetoGeneric(String id, Map<String, Object> map) {
        
    }
    
    
    @Override
    public String getName(Locale locale) {
        // TODO Auto-generated method stub
        return null;
    }

    @Override
    public String getDescription(Locale locale) {
        // TODO Auto-generated method stub
        return null;
    }

    @Override
    public long getStartOfCalendarBeforeUnixEpoch() {
        // TODO Auto-generated method stub
        return 0;
    }

    @Override
    public long startOfCalendarInDaysBeforeJavaEpoch() {
        // TODO Auto-generated method stub
        return 0;
    }

    @Override
    public LetoPeriodType[] getCalendarPeriodTypes() {
        // TODO Auto-generated method stub
        return null;
    }


    @Override
    protected LocaleStringId getNameTranslationIndex() {
        // TODO Auto-generated method stub
        return null;
    }


    @Override
    protected LocaleStringId getDescriptionTranslationIndex() {
        // TODO Auto-generated method stub
        return null;
    }


}
