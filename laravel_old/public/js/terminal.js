jQuery(function($, undefined) { 
// LOGIN
// The prompts, the validators, and the error messages
var prompts = [
  {
    title: 'nafn: ', 
    validator: function(cmd){
      return /^[A-Za-zá-öÁ-Ö ]*$/.test(cmd);
    }, 
    errormsg: 'Nafn getur einungis innihaldið bókstafi eða bil',
    optional: false
  }, 
  {
    title: 'tölvupóstur: ',
    validator: function(cmd){
      return /^[^@]+@[^@]+\.[^@]+$/.test(cmd);
    },
    errormsg: 'Tölvupóstfang gengur ekki',
    optional: false
  },
  {
    title: 'símanúmer(valfrjálst): ',
    validator: function(cmd){
      return /^(\+354[- ]?)?[\d]{3}[\s-]?[\d]{4}$/.test(cmd);
    },
    errormsg: 'Símanúmer eru venjulega á forminu XXX-XXXX',
    optional: true
  }
  ];
  //The stuff the user entered, gradually gets filled
var signin_stuff = [];
//The number of times the user has entered stuff
var count = 0;
//Terminal handler
var term_handler = function(command, term) {
  if (!prompts[count  % 4].optional && command === "")
  {
    term.echo(prompts[count % 4].title.substring(0,prompts[count % 4].title.length - 2) + " má ekki vera tómt!");
    return;
  }
  else if(command !== "" && !prompts[count  % 4].validator(command)){
    term.echo(prompts[count % 4].errormsg);
    return;
   }
  var idx = ++count % 4;
  if (idx < 3) {
    signin_stuff.push(command); //add to list
    term.push(arguments.callee, {prompt: prompts[idx].title});
  } else {
    signin_stuff.push(command);
    term.push(function(command, term) {
        if (command == 'j') {
          count++;
          term.pop().pop().pop();
          term.pause();
          var login_info = {};
          for (var i = 0; i < signin_stuff.length; i++) {
            login_info[prompts[i].title.substring(0,prompts[i].title.length - 2)] = signin_stuff[i];
          }
          $.ajax({
              url: "/",
              type: "POST",
              data: login_info,
              success: function(data){
                if (data.success)
                {
                  term.echo('Velkomin/n í forritunarklúbbinn!');
                }
                else
                {
                  term.echo("Nýskráning gekk ekki, reynið aftur síðar");
                  term.push(term_handler, {prompt: prompts[0].title});
                }
              },
              error: function(){
                term.echo("Nýskráning gekk ekki, reynið aftur síðar");
                term.push(term_handler, {prompt: prompts[0].title});
              }
          });
        } else {
          term.push(term_handler, {prompt: prompts[0].title});
        }
    }, {prompt: 'skrá í klúbb (j/n): '});
  }
}


$('#terminal').terminal(term_handler, {
  height: 400,
  history: false,
  prompt: prompts[0].title,
  enabled: false,
  greetings: "Skráning í Forritunarklúbbinn"
}).focus(true);

});
