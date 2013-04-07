//Created by James Elías Sigurðarson 2013

jQuery(function($, undefined) {

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

  var term_data = {
    prompts: prompts,
    submit: 'skrá í klúbb (j/n): ',
    url: '/login',
    type: 'POST',
    success: function(data, term)
    {
      if (data.success)
      {
        term.echo('Velkomin/n í forritunarklúbbinn!');
        window.location = data.redirect;
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
      term.echo("Innskráning gekk ekki, reynið aftur síðar");
    },
    terminal: {
      height: 400,
      history: false,
      enabled: false,
      greetings: "Innskráning í Forritunarklúbbinn"
    }
  };
  $('#terminal').formTerminal(term_data);
});
