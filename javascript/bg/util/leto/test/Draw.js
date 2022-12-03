function Draw() {

    
    
    this.getCharacter = function (i) {
        switch (i) {
           case 0: return '0';
           case 1: return '1';
           case 2: return '2';
           case 3: return '3';
           case 4: return '4';
           case 5: return '5';
           case 6: return '6';
           case 7: return '7';
           case 8: return '8';
           case 9: return '9';
           default: return ' ';
        }
    }
    /**
     * 
     * @param year
     * @param monthName
     * @param numDays
     * @param startAtDayOfWeek Should be between 0 and 6. 0 means Monday and 6 means Sunday.
     * @param todayInMonth
     * @return
     */
    this.drawMonth = function (year, monthName, numDays, startAtDayOfWeek, todayInMonth) {
        if (startAtDayOfWeek >=7 ) {
            throw new Error("Starting day of week cannot be " + startAtDayOfWeek 
                     + ". It should be between 0 and 7.");
        }
        if (startAtDayOfWeek < 0) {
            throw new Error("Starting day of week cannot be negative (" + startAtDayOfWeek + ").");
        }
        if (numDays >= 100) {
            throw new Error("A month of " + numDays + " days is not allowed. Month is not allowed to have "
                     + "more than 99 days. That is because each day should be no more than two deciimal digits.");
        }
        if (numDays <= 0) {
            throw new Error("A month of " + numDays 
                     + " days is not allowed. Month should have at least one day.");
        }
        if (todayInMonth != -1 && (todayInMonth <= 0 || todayInMonth > numDays)) {
            throw new Error("Todays date (" + todayInMonth + ") is not allowed to be outside the range 0 : " 
                     + numDays + " , since month " + monthName + " " + year + " is requested to have " + numDays 
                     + " days.");
        }
        var rows = numDays + startAtDayOfWeek;
        rows = (rows / 7) + (rows % 7 > 0 ? 1 : 0);
        var month = new char[2 + rows][22];
        for (var i = 0; i < month.length; i++) {
            for (var j = 0; j < month[i].length; j++) {
                month[i][j] = ' ';
            }
        }
        var monthNameFull = monthName;
        if (year != -1) { 
            monthNameFull += " " + year;
        }
        if (monthNameFull.length() > 22) {
            monthNameFull = monthName;
            if (monthNameFull.length() > 22) {
                monthNameFull = monthNameFull.substring(0, 21);
            }
        }
        var index = (22 - monthNameFull.length()) / 2;
        for (var i = 0; i < monthNameFull.length(); i++) {
            month[0][index] = monthNameFull.charAt(i);
            index++;
        }
        var daysString = " Ð¿Ð½ Ð²Ñ‚ Ñ�Ñ€ Ñ‡Ñ‚ Ð¿Ñ‚ Ñ�Ð± Ð½Ð´";
        for (var i = 0; i < daysString.length(); i++) {
            month[1][i] = daysString.charAt(i);
        }
        var row = 2;
        var dayOfWeek = startAtDayOfWeek;
        for (var i = 1; i <= numDays; i++) {
            index = (dayOfWeek * 3) + 1;
            if (todayInMonth == i) {
                month[row][index - (i / 10 > 0 ? 1 : 0)] = '[';
                month[row][index + 2] = ']';
            }
            if (i >= 10) {
                month[row][index] = getCharacter(i / 10); 
            }
            index ++;
            month[row][index] = getCharacter(i % 10);
            dayOfWeek++;
            if (dayOfWeek >= 7) {
                dayOfWeek = 0;
                row++;
            }
        }
        return month;
    }
    
    this.drawYear = function (year) {
        var  numberPerRow = 4;
        var len = year.size();
        var bigrows = len / numberPerRow + (len % numberPerRow > 0 ? 1 : 0); 
        var sizes = new Array();
        for (var i = 0; i < bigrows; i++) { sizes = new Arra(0, 0); } 
        for (var i =0; i < sizes.length; i++) {
            for (var j = 0; j < sizes[i].length; j++) {
                sizes[i][j] = 0;
            }
        }
        var allRows = 0;
        var allColumns = 0;
        var index = 0;
        for (var bigRow =0; bigRow < bigrows; bigRow++) {
            for (var bigColumn =0; bigColumn < numberPerRow && index < year.size(); bigColumn++) {
                var month = year.get(index);
                sizes[bigRow][0] += month[0].length;      // Columns
                if(month.length > sizes[bigRow][1]) {
                    sizes[bigRow][1] = month.length;      // Rows
                }
                index ++;
            }
            allRows += sizes[bigRow][1];
            if (sizes[bigRow][0] > allColumns) {
                allColumns = sizes[bigRow][0];
            }
        }
        
        var matrix = new Array(); 
        for (var i =0; i < allRows; i++) { 
           matrix[i] = new Array(); 
           for (var j = 0; j < allColumns; j++) {
             matrix[i][j] = ' ';
           }
        }
        for (var i = 0; i < matrix.length; i++) {
            for (var j = 0; j < matrix[i].length; j++) {
                matrix[i][j] = ' ';
            }
        }
        
        var bigRow = 0;
        var row = 0; 
        var column = 0;
        var monthNumber = 0;
        for (index =0; index < year.size(); index++) { 
            var month = year.get(index);
            
            var currentRow = row;
            for (var i = 0; i < month.length; i++) {
                var currentCol = column;
                for (var j = 0; j < month[i].length; j++) {
                    matrix[currentRow][currentCol] = month[i][j];
                    currentCol++;
                }
                currentRow++;
            }
            
            column = column + month[0].length;
            monthNumber++;
            if (monthNumber % numberPerRow == 0) {
                row = row + sizes[bigRow][1];
                column = 0;
                bigRow++;
            }
        }
        return matrix;
    }
    
    this.printMatrix = function (matrix) {
        for (var i =0; i < matrix.length; i++) {
            for (var j = 0; j < matrix[i].length; j++) {
                print(matrix[i][j]);
            }
            println();
        }
    }
    
    this.mainGrigorian = function (argv) {
        var january  = drawMonth(-1, "Ð¯Ð½ÑƒÐ°Ñ€Ð¸",    31, 6, -1);
        var february = drawMonth(-1, "Ð¤ÐµÐ²Ñ€ÑƒÐ°Ñ€Ð¸",  29, 2, -1);
        var march    = drawMonth(-1, "ÐœÐ°Ñ€Ñ‚",      31, 3, -1);
        var april    = drawMonth(-1, "Ð�Ð¿Ñ€Ð¸Ð»",     30, 6, -1);
        var may      = drawMonth(-1, "ÐœÐ°Ð¹",       31, 1, -1);
        var june     = drawMonth(-1, "Ð®Ð½Ð¸",       30, 4, 22);
        var july     = drawMonth(-1, "Ð®Ð»Ð¸",       31, 6, -1);
        var august   = drawMonth(-1, "Ð�Ð²Ð³ÑƒÑ�Ñ‚",    31, 2, -1);
        var september= drawMonth(-1, "Ð¡ÐµÐ¿Ñ‚ÐµÐ¼Ð²Ñ€Ð¸", 30, 5, -1);
        var october  = drawMonth(-1, "ÐžÐºÑ‚Ð¾Ð¼Ð²Ñ€Ð¸",  31, 0, -1);
        var november = drawMonth(-1, "Ð�Ð¾ÐµÐ¼Ð²Ñ€Ð¸",   30, 3, -1);
        var december = drawMonth(-1, "Ð”ÐµÐºÐµÐ¼Ð²Ñ€Ð¸",  31, 5, -1);
        var year = new Array();
        year.add(january);
        year.add(february);
        year.add(march);
        year.add(april);
        year.add(may);
        year.add(june);
        year.add(july);
        year.add(august);
        year.add(september);
        year.add(october);
        year.add(november);
        year.add(december);
        
        matrix = drawYear(year);
        printMatrix(matrix);
    }
    
    this.mainBulgarian = function (argv) {
        var january  = drawMonth(-1, "ÐŸÑŠÑ€Ð²Ð¸",      31, 6, -1);
        var february = drawMonth(-1, "Ð’Ñ‚Ð¾Ñ€Ð¸",      30, 2, -1);
        var march    = drawMonth(-1, "Ð¢Ñ€ÐµÑ‚Ð¸",      30, 3, -1);
        var april    = drawMonth(-1, "Ð§ÐµÑ‚Ð²ÑŠÑ€Ñ‚Ð¸",   31, 6, -1);
        var may      = drawMonth(-1, "ÐŸÐµÑ‚Ð¸",       30, 1, -1);
        var june     = drawMonth(-1, "Ð¨ÐµÑ�Ñ‚Ð¸",      30, 4, 22);
        var eni      = drawMonth(-1, "Ð•Ð½Ð¸-Ð”Ð¶Ð¸Ñ‚ÐµÐ¼", 1,  1, -1);
        var july     = drawMonth(-1, "Ð¡ÐµÐ´Ð¼Ð¸",      31, 6, -1);
        var august   = drawMonth(-1, "ÐžÑ�Ð¼Ð¸",       30, 2, -1);
        var september= drawMonth(-1, "Ð”ÐµÐ²ÐµÑ‚Ð¸",     30, 5, -1);
        var october  = drawMonth(-1, "Ð”ÐµÑ�ÐµÑ‚Ð¸",     31, 0, -1);
        var november = drawMonth(-1, "Ð•Ð´Ð¸Ð½Ð°Ð¹Ñ�Ñ‚Ð¸",  30, 3, -1);
        var december = drawMonth(-1, "Ð”Ð²Ð°Ð½Ð°Ð¹Ñ�Ñ‚Ð¸",  30, 5, -1);
        var ani      = drawMonth(-1, "Ð�Ð½Ð¸-Ð�Ð»ÐµÐ¼",   1,  1, -1);
        var year = new Array();
        year.add(january);
        year.add(february);
        year.add(march);
        year.add(april);
        year.add(may);
        year.add(june);
        year.add(eni);
        year.add(july);
        year.add(august);
        year.add(september);
        year.add(october);
        year.add(november);
        year.add(december);
        year.add(ani);
        
        var matrix = drawYear(year);
        printMatrix(matrix);
    }
    
    this.main = function (argv) {
        
        
        var locale = "bg";
        //var l = new LetoBulgarian();
        var l = new LetoBulgarian();
        var periods = l.getToday();
        if (periods == null || periods.length < 3) {
            throw new Error("Insufficient periods supported by calendar. No visuatiozation is possible.");
        }
        var day = periods[0];
        var month = periods[1];
        var year = periods[2];
        
        var d = year.startsAtDaysAfterEpoch();
        var weekday = (int) ((d )% 7);
        
        
        
        println("   " + (year.getAbsoluteNumber() + 1) + " " + year.getType().getName("en"));
        var structure = year.getStructure();
        var months = structure.getSubPeriods();
        
        var yearDraw = new Array();

        for (var i =0 ; i < months.length; i++) {
            var currentDay = -1;
            if (month.getNumber() == i) {
                currentDay = (day.getNumber()) + 1;
            }
            monthDraw = drawMonth(-1, months[i].getName(locale),  months[i].getTotalLengthInDays(), 
                            weekday, currentDay);
            yearDraw.add(monthDraw);
            weekday = weekday + (int)months[i].getTotalLengthInDays();
            weekday = weekday % 7;
        }
        var matrix = drawYear(yearDraw);
        printMatrix(matrix);

    }

}
