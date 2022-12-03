package bg.util.leto.api;

/**
 * This is generic exception indicating some unrecoverable error while calculating Leto/Calendar 
 * dates.
 */
public class LetoExceptionUnrecoverable extends RuntimeException {
    
    /** Serial Version ID, because this is a serialized object.*/
    private static final long serialVersionUID = -7758060458277487244L;

    /**
     * Create new unrecoverable exception event with message that describes what exactly went wrong. 
     * Programmers should try to make message as descriptive as possible and containing 
     * valuable information about the state of the environment at the time when the exception happened. 
     * @param message Description about what exactly went wrong and why.
     */
    public LetoExceptionUnrecoverable(String message) {
        super(message);
    }
    
    /**
     * Create new unrcoverable exception event with a message and with a subexception. 
     * 
     * @param message Describes what exactly went wrong and why. Programmers should try to make this message 
     *                as descriptive as possible. It should also contain information about the state of the 
     *                environment at the time when the exception happened. This message should explain 
     *                not only what went wrong, but also why.
     * @param t       The sub-exception/throwable  which was the reason for the failure. It is highly recommended to use 
     *                this constructor in cases when the LetoException is being generated from within a 
     *                catch block. In that case the <code>t</code> Throwable should be set to the original 
     *                exception caught in the catch block. 
     */
    public LetoExceptionUnrecoverable(String message, Throwable t) {
        super(message, t);
    }

}

