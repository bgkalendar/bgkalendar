
function LetoPeriodBean() {

    this.mAbsoluteNumber = 0;
    
    this.mNumber = 0;
    
    this.mActualName = "";
    
    this.mType = null;
    
    this.mStructure = null;
    
    this.mStartAfterEpoch = 0;
    
    this.setStartAtDaysAfterEpoch = function (days) { this.mStartAfterEpoch = days; }
    
    this.setAbsoluteNumber = function (absoluteNumber) { this.mAbsoluteNumber = absoluteNumber; }
    
    this.getAbsoluteNumber = function () { return this.mAbsoluteNumber; }

    this.setActualName = function (name) {
      if (name == null) {
        throw new Error("The actual name of a period cannot be null."
          + "If you want to leave it unspecified, please use empty string \"\" instead."
          + "Examples for such names are: \"Monday\", \"Tuesday\", \"Wednessday\", etc... "
          + "if the period is day of the week for examle.");
      }
      this.mActualName = name;
    }
    
    this.getActualName = function () { return this.mActualName; }

    this.setNumber = function (number) { this.mNumber = number; }
    
    this.getNumber = function () { return this.mNumber; }

    this.setType = function (type) { this.mType = type; }
    
    this.getType = function () { return this.mType; }

    this.setStructure = function (structure) { this.mStructure = structure; }
    
    this.getStructure = function () { return this.mStructure; }

    this.startsAtDaysAfterEpoch = function () { return this.mStartAfterEpoch; }

}

if (module != null && module.exports != null)  {
  module.exports = LetoPeriodBean
}

