//Created by James Elías Sigurðarson 2013

$.fn.formTerminal = function(input){
  //The stuff the user entered, gradually gets filled
  var data = [];
  //The number of times the user has entered stuff
  var count = 0;
  //Terminal handler
  var term_handler = function(command, term) {
    //Validate the command, if it passes it continues, otherwise it fails
    var idx = count % (input.prompts.length + 1);
    var prompt = input.prompts[idx];
    if (!prompt.optional && command === "")
    {
      term.echo(prompt.title.substring(0,prompt.title.length - 2) + " má ekki vera tómt!");
      return;
    }
    else if(command !== "" && !input.prompts[idx].validator(command)){
      term.echo(prompt.errormsg);
      return;
    }
    //The next prompt
    idx = ++count % (input.prompts.length + 1);
    prompt = input.prompts[idx];
    //
    //Checks if it should mask the input
    term.set_mask(typeof prompt !== 'undefined' && prompt.password);

    //If the next prompt is real, then show that, otherwise show the final message
    if (idx < input.prompts.length) {
      data.push(command); //add to list
      term.push(arguments.callee, {prompt: prompt.title});
    } else {
      data.push(command);

      //Adds the Ajax handler for posting the form
      term.push(function(command, term) {
          if (command == 'j') {
            count++;
            while(term.level() > 1) term.pop();
            if (typeof input.preSubmit == 'function') input.preSubmit(term);
            term.pause();
            var post_data = {};
            for (var i = 0; i < data.length; i++) {
              post_data[input.prompts[i].field] = data[i];
            }
            $.ajax({
                url: input.url,
                type: input.type,
                data: post_data,
                success: function(data){
                  if (!input.success(data,term)){
                    term.resume();
                  }
                },
                error: function(){
                  input.error(term);
                  term.resume();
                }
            });
          } else {
            while(term.level() > 1) term.pop();
          }
      }, {prompt: input.submit});
    }
  };
  var term_data = {
    height: 400,
    history: false,
    prompt: input.prompts[0].title,
    mask: input.prompts[0].password,
    enabled: false,
    greetings: false
  };
  $.extend(term_data,input.terminal);

  this.terminal(term_handler, term_data).focus(true);
};

