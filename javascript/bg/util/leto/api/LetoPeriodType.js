/**
 * An interface to define an abstract period type, such as day, month, year, 
 * century and so on...
 * <br/><br/>
 * 
 * Each calendar splits the time into abstract periods of time. Each of the i
 * supported periods is defined internally by an implementation of 
 * LetoPeriodType.
 * <br/><br/>
 * 
 * The main characteristics of the period type are: 
 * <table>
 *    <tr><td>Characteristic</td>  <td>Description</td></tr>
 *    <tr><td>Name</td>            <td>The name of the period type. Examples: "day", "month", "year", "century", 
 *                                          ...
 *                                      </td></tr>
 *    <tr><td>Description</td>            <td>Human readable description about the period type.</td></tr>
 *    <tr><td>Possible Structures</td>    <td>This is an array of possibilities which show how exactly the period is 
 *                                          structured and what sub-periods it contains. For example for the period 
 *                                          type "month" in Gregorian calendar, this array would show 4 possibilities 
 *                                          (an array of 4 elements): 
 *                                          <ol>
 *                                             <li>Month containing 28 days</li>
 *                                             <li>Month containing 29 days</li>
 *                                             <li>Month containing 30 days</li>
 *                                             <li>Month containing 31 days</li>
 *                                          </ol>
 *                                          Another example could be the period type "year" in Gregorian calendar. 
 *                                          It would have 2 possible structures: one for non-leap years and another 
 *                                          for leap years:
 *                                          <ol>
 *                                             <li>Non-Leap: 365 days, January (31), February (28), March(31), ...</li>
 *                                             <li>Leap:     366 days, January (31), February (29), March(31), ...</li>
 *                                          </ol> 
 *                                      </td></tr>
 * </table>
 *
 */
function LetoPeriodType() {
  this.names = {"bg": null, "en": null, "de": null, "ru": null};

    
  /**
   * Get the name of this period type in the default locale.
   * @return The name of this period type in the default locale.
   */
  this.getName = function () { return this.names["bg"]; }
    
  /**
   * The name of the period type. For example: "day", "month", "year", 
   * "century" and so on...
   * @return The name of this period type.
   */
  this.getName = function (locale) { return this.names[locale]; }
    
  /**
   * Get the available translations of the name of this period type in 
   * different human spoken languages.
   * @return The available translations of the name of this period type in 
   * different human spoken languages.
   */
  this.getNameTranslations = function () { return this.names; }
    
  /**
   * Get the human readable description of this period type in the default 
   * locale.
   * @return The human readable long description of this period type using the i
   * default locale.
   */
  this.getDescription = function () { return this.descriptions["bg"]; } 
    
  /**
   * Longer human readable description of the period type.  
   * @return Longer human readable description of the given period type.
   */
  this.getDescription = function (locale) { return this.descriptions[locale]; }
    
  /**
   * Get the available translations in human spoken languages of this period 
   * type description.
   * @return The available translations to human spoken languages of this 
   *         period type description.
   */
  this.getDescriptionTranslations = function () { return this.descriptions; }
     
  /**
   * Return the possible structures for this period type. Each possible 
   * structure is defined as an element of the array returned. Each possible 
   * structure contains the duration of the period in days as well as 
   * information about how much sub-periods it contains.<br/>
   * For example in Gregorian calendar, the month period type should return an 
   * array of 4 elements like this:
   * <table border="1">
   *    <tr><td>Number</td>    <td>Duration in days  </td>       <td>Description</td>                         </tr>
   *    
   *    <tr><td>1-st  </td>    <td>duration - 28 days</td>       <td>February in non leap year</td>           </tr>
   *    <tr><td>2-nd  </td>    <td>duration - 29 days</td>       <td>February in a leap year  </td>           </tr>
   *    <tr><td>3-rd  </td>    <td>duration - 30 days</td>       <td>April, June, September, November</td>    </tr>
   *    <tr><td>4-th  </td>    <td>duration - 31 days</td>       <td>January, March, May, July, August, October, 
   *                                                                 December                        </td>    </tr>
   * </table>
   *   
   * @return An array containing all of the possible structures of this period 
   * type.
   */
  this.getPossibleStructures = function () { return null; }
     
};

if (module != null && module.exports != null)  {
  module.exports = LetoPeriodType
}

