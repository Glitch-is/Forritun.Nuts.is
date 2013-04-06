//Created by James Elías Sigurðarson 2013

jQuery(function($, undefined) {
// LOGIN
// The prompts, the validators, and the error messages
var prompts = [
  
  {
    title: 'tölvupóstur: ',
    field: 'email',
    validator: function(cmd){
      return /^[^@]+@[^@]+\.[^@]+$/.test(cmd);
    },
    errormsg: 'Tölvupóstfang gengur ekki',
    optional: false,
    password: false
  },
  {
    title: 'lykilorð: ',
    field: 'password',
    validator: function(cmd){
      return true;
    },
    errormsg: '',
    optional: false,
    password: true
  }
  ];
  //The stuff the user entered, gradually gets filled
var data = [];
//The number of times the user has entered stuff
var count = 0;
//Terminal handler
var term_handler = function(command, term) {
  //Validate the command, if it passes it continues, otherwise it fails
  var idx = count % (prompts.length + 1);
  var prompt = prompts[idx];
  if (!prompt.optional && command === "")
  {
    term.echo(prompt.title.substring(0,prompt.title.length - 2) + " má ekki vera tómt!");
    return;
  }
  else if(command !== "" && !prompts[idx].validator(command)){
    term.echo(prompt.errormsg);
    return;
  }
  //The next prompt
  idx = ++count % (prompts.length + 1);
  prompt = prompts[idx];
  //
  //Checks if it should mask the input
  if (typeof prompt !== 'undefined' && prompt.password) term.set_mask(true);
  else term.set_mask(false);

  //If the next prompt is real, then show that, otherwise show the final message
  if (idx < prompts.length) {
    data.push(command); //add to list
    term.push(arguments.callee, {prompt: prompt.title});
  } else {
    data.push(command);

    //Adds the Ajax handler for posting the form
    term.push(function(command, term) {
        if (command == 'j') {
          count++;
          while(term.level() > 1) term.pop();

          term.pause();
          var post_data = {};
          for (var i = 0; i < data.length; i++) {
            post_data[prompts[i].field] = data[i];
          }
          $.ajax({
              url: "/login",
              type: "POST",
              data: post_data,
              success: function(data){
                if (data.success)
                {
                  term.echo('Velkomin/n í forritunarklúbbinn!');
                }
                else
                {
                  term.echo(data.error);
                  term.resume();
                }
              },
              error: function(){
                term.resume();
                term.echo("Innskráning gekk ekki, reynið aftur síðar");
              }
          });
        } else {
          while(term.level() > 1) term.pop();
        }
    }, {prompt: 'skrá í klúbb (j/n): '});
  }
};


$('#terminal').terminal(term_handler, {
  height: 400,
  history: false,
  prompt: prompts[0].title,
  enabled: false,
  greetings: "Innskráning í Forritunarklúbbinn"
}).focus(true);

});
