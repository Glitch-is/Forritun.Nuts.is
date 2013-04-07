//Created by James Elías Sigurðarson 2013

jQuery(function($, undefined) {

var prompts = [
  {
    title: 'lykilorð: ',
    field: 'password',
    validator: function(cmd){
      return true;
    },
    errormsg: '',
    optional: false,
    password: true
  },
  {
    title: 'lykilorð(aftur): ',
    field: 'password_confirmation',
    validator: function(cmd){
      return true;
    },
    errormsg: '',
    optional: false,
    password: true
  }
  ];

  var term_data = {
    prompts: prompts,
    submit: 'endurstilla lykilorð (j/n): ',
    url: '/reset',
    type: 'POST',
    success: function(data, term)
    {
      if (data.success)
      {
        term.echo('lykilorð endursett!');
        window.location = '/login';
        return true;
      }
      else
      {
        term.echo(data.error);
        return false;
      }
    },
    error: function(term)
    {
      term.echo("Endurstilling á lykilorði gekk ekki, reynið aftur síðar.");
    },
    additional_data: { 'token' : window.token },
    terminal: {
      height: 400,
      history: false,
      enabled: false,
      greetings: "Endurstilling á lykilorði"
    }
  };
  $('#terminal').formTerminal(term_data);
});
