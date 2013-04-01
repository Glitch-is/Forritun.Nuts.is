jQuery(function($, undefined) { 
// LOGIN
var prompts = ['nafn: ', 'tölvupóstur: ', 'símanúmer: '];
var signin_stuff = [];
var count = 1;
//Terminal handler
var term_handler = function(command, term) {
  var idx = count++ % 4;
  if (idx < 3) {
    signin_stuff.push(command); //push the same function with diffrent prompt
    term.push(arguments.callee, {prompt: prompts[idx]});
  } else {
    signin_stuff.push(command);
    term.push(function(command, term) {
        console.log(command);
        if (command == 'j') {
          count++;
          term.pop().pop().pop();
          term.pause();
          var login_info = {};
          for (var i = 0; i < signin_stuff.length; i++) {
            login_info[prompts[i].substring(0,prompts[i].length - 2)] = signin_stuff[i]
          };
          console.log(login_info);
          $.post('/',login_info);
        } else {
          term.push(term_handler, {prompt: prompts[0]});;
        }
    }, {prompt: 'skrá í klúbb (j/n): '});
  }
}


$('#terminal').terminal(term_handler, {greetings: false,
  height: 100,
  history: false,
  prompt: prompts[0],
  enabled: false,
  greetings: "Skráning í Forritunarklúbbinn"
}).focus(true);

});
