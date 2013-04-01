jQuery(function($, undefined) { 
// LOGIN
var prompts = [
  {
    title: 'nafn: ', 
    validator: function(cmd){
      return /^[\w ]*$/.test(cmd)
    }, 
    errormsg: 'Nafn getur einungis innihaldið bókstafi'
  }, 
  {
    title: 'tölvupóstur: ',
    validator: function(cmd){
      return /^[^@]+@[^@]+\.[^@]+$/.test(cmd)
    }, 
    errormsg: 'Tölvupóstfang gengur ekki'
  },
  {
    title: 'símanúmer: ', 
    validator: function(cmd){
      return /^[\d]{3}\s?[\d]{4}$/.test(cmd)
    },
    errormsg: 'Símanúmer er rangt: XXX-XXXX'
  } 
  ];
var signin_stuff = [];
var count = 0;
//Terminal handler
var term_handler = function(command, term) {
  var idx = ++count % 4;
  if (idx < 3) {
    if(prompts[(count - 1) % 4].validator(command))
    {
      signin_stuff.push(command); //add to list
      term.push(arguments.callee, {prompt: prompts[idx].title});
    }
    else{
      count--;
      term.echo(prompts[count % 4].errormsg);
    }
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
          $.post('/',login_info, function(data){
            if (data.success)
            {
              term.echo('Velkomin/n í forritunarklúbbinn!');
            }
            else
            {
              term.echo("Nýskráning gekk ekki, reynið aftur síðar");
              term.push(term_handler, {prompt: prompts[0].title});;
            }
          }, "json");
        } else {
          term.push(term_handler, {prompt: prompts[0].title});
        }
    }, {prompt: 'skrá í klúbb (j/n): '});
  }
}


$('#terminal').terminal(term_handler, {greetings: false,
  height: 400,
  history: false,
  prompt: prompts[0].title,
  enabled: false,
  greetings: "Skráning í Forritunarklúbbinn"
}).focus(true);

});
