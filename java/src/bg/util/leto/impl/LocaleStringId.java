package bg.util.leto.impl;

import java.util.Locale;
import java.util.Map;

public class LocaleStringId {
  private String mValue = null;
  private String mDefaultValue = null;
  public LocaleStringId(String id) {
      mValue = id;
  }
  public LocaleStringId(String id, String defaultValueIfNotFound) {
      mValue = id;
      mDefaultValue = defaultValueIfNotFound;
  }
  
  public LocaleStringId(String id, String defaultValueIfNotFound, Map<Locale, String> translations) {
      this(id, defaultValueIfNotFound);
      LocaleStrings.addTranslations(this, translations);
  }
  
  public String getId() {
      return mValue;
  }
  
  public String getDefaultValue() {
      return mDefaultValue;
  }
}
