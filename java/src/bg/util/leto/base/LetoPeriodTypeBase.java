package bg.util.leto.base;

import bg.util.leto.api.LetoPeriodType;

import java.util.Locale;

import bg.util.leto.api.LetoPeriodStructure;

public abstract class LetoPeriodTypeBase implements LetoPeriodType {
    
    @Override
    public abstract String getDescription(Locale locale);

    @Override
    public abstract String getName(Locale locale);

    @Override
    public abstract LetoPeriodStructure[] getPossibleStructures();


}
