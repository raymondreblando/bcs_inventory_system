function initialize_pattern(selector, pattern) {
       var elements = document.querySelectorAll(selector);
       elements.forEach(function(element) {
         var options = {
           blocks: pattern.blocks,
           delimiter: pattern.delimiter,
           uppercase: pattern.uppercase,
           numericOnly: pattern.numericOnly
         };
   
         if (pattern.moneyFormat) {
            options.numeral = true;
            options.numeralDecimalMarkRaw = pattern.moneyFormat.decimalMark;
            options.delimiter = pattern.moneyFormat.delimiter;
            options.numeralDecimalScale = pattern.moneyFormat.decimalScale;
            options.prefix = '';
            options.noImmediatePrefix = true;
          }
   
         new Cleave(element, options);
       });
  }
  var money ={
       blocks: [Infinity],
       delimiter: '',
       uppercase: false,
       numericOnly: false,
       moneyFormat: {
         decimalMark: '.',
         delimiter: ',',
         decimalScale: 2
       }
  };
  var num_only = {
      blocks: [11],
      delimiter: '',
      uppercase: false,
      numericOnly: true
  };
  initialize_pattern('.money', money);
  initialize_pattern('.num_only', num_only);
  
  
  