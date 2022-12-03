
/**
 * This is generic exception indicating some unrecoverable error while 
 * calculating Leto/Calendar dates.
 */
function LetoException(message, causeException) {
  this.message = message;
  this.cause   = causeException;
  this.getMessage   = function () { return this.message; }
  this.getException = function () { return this.cause;   } 

}

if (module != null && module.exports != null)  {
  module.exports = LetoException
}


