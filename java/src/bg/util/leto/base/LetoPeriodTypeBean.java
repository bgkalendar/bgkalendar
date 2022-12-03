package bg.util.leto.base;

import java.util.Locale;
import java.util.Map;

import bg.util.leto.api.LetoExceptionUnrecoverable;
import bg.util.leto.api.LetoPeriodStructure;
import bg.util.leto.impl.LocaleStringId;
import bg.util.leto.impl.LocaleStrings;

public class LetoPeriodTypeBean extends LetoPeriodTypeBase {

    private LocaleStringId mNameTranslationIndex = null;
    
    private LocaleStringId mDescriptionTranslationIndex = null;
    
    private LetoPeriodStructure[] mPossibleStructures = null;
    
    public LetoPeriodTypeBean(LocaleStringId nameTranslationIndex, LocaleStringId descriptionTranslationIndex, 
                              LetoPeriodStructure[] structures) 
    throws LetoExceptionUnrecoverable
    {
        setName(nameTranslationIndex);
        setDescription(descriptionTranslationIndex);
        setPossibleStructures(structures);
        if (structures != null) {
            for (int i = 0; i < structures.length; i++) {
                structures[i].setPeriodType(this);             // Can throw LetoException 
            }
        }
    }

    public void setDescription(LocaleStringId descriptionTranslationIndex) {
        mDescriptionTranslationIndex = descriptionTranslationIndex;
    }
    
    public void setName(LocaleStringId nameTranslationIndex) {
        mNameTranslationIndex = nameTranslationIndex;
    }
    
    @Override
    public String getName() {
        return getName(Locale.ENGLISH);
    }
    
    @Override
    public String getName(Locale locale) {
        return LocaleStrings.get(mNameTranslationIndex, locale, null);
    }

    @Override
    public String getDescription() {
        return getDescription(Locale.ENGLISH);
    }
    

    @Override
    public String getDescription(Locale locale) {
        return LocaleStrings.get(mDescriptionTranslationIndex, locale, null);
    }
    
    @Override
    public Map<Locale, String> getNameTranslations() {
        Map<Locale, String> translations = LocaleStrings.get(mNameTranslationIndex);
        return translations;
    }
    
    @Override
    public Map<Locale, String> getDescriptionTranslations() {
        Map<Locale, String> translations = LocaleStrings.get(mDescriptionTranslationIndex);
        return translations;
    }

    public void setPossibleStructures(LetoPeriodStructure[] structures) {
        mPossibleStructures = structures;
    }
    
    @Override
    public LetoPeriodStructure[] getPossibleStructures() {
        return mPossibleStructures;
    }
    
    @Override
    public String toString() {
        return getName(LocaleStrings.ENGLISH);
    }

}
