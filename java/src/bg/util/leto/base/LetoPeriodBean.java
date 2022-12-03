package bg.util.leto.base;

import bg.util.leto.api.LetoPeriod;
import bg.util.leto.api.LetoPeriodStructure;
import bg.util.leto.api.LetoPeriodType;

public class LetoPeriodBean implements LetoPeriod {

    private long mAbsoluteNumber = 0;
    
    private long mNumber = 0;
    
    private String mActualName = "";
    
    private LetoPeriodType mType = null;
    
    private LetoPeriodStructure mStructure = null;
    
    private long mStartAfterEpoch = 0;
    
    public void setStartAtDaysAfterEpoch(long days) {
        mStartAfterEpoch = days;
    }
    
    public void setAbsoluteNumber(long absoluteNumber) {
        mAbsoluteNumber = absoluteNumber;
    }
    
    @Override
    public long getAbsoluteNumber() {
        return mAbsoluteNumber;
    }

    public void setActualName(String name) throws IllegalArgumentException {
        if (name == null) {
            throw new IllegalArgumentException("The actual name of a period cannot be null."
                    + "If you want to leave it unspecified, please use empty string \"\" instead."
                    + "Examples for such names are: \"Monday\", \"Tuesday\", \"Wednessday\", etc... "
                    + "if the period is day of the week for examle.");
        }
        mActualName = name;
    }
    
    @Override
    public String getActualName() {
        return mActualName;
    }

    public void setNumber(long number) {
        mNumber = number;
    }
    
    @Override
    public long getNumber() {
        return mNumber;
    }

    public void setType(LetoPeriodType type) {
        mType = type;
    }
    
    @Override
    public LetoPeriodType getType() {
        return mType;
    }

    public void setStructure(LetoPeriodStructure structure) {
        mStructure = structure;
    }
    
    @Override
    public LetoPeriodStructure getStructure() {
        return mStructure;
    }

    @Override
    public long startsAtDaysAfterEpoch() {
        return mStartAfterEpoch;
    }

}
