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
  }
  ];

  var term_data = {
    prompts: prompts,
    submit: 'senda póst (j/n): ',
    url: '/forgot',
    type: 'POST',
    success: function(data, term)
    {
      if (data.success)
      {
        term.echo('Upplýsingar varðandi endurstillingu á lykilorði hafa verið sendar til þín í pósti');
        return true;
      }
      else
      {
        term.echo("Gekk ekki að senda póst, reynið aftur síðar");
        return false;
      }
    },
    error: function(term)
    {
      term.echo("Gekk ekki að senda póst, reynið aftur síðar");
    },
    terminal: {
      height: 400,
      history: false,
      enabled: false,
      greetings: "Gleymt lykilorð"
    }
  };
  $('#terminal').formTerminal(term_data);
});
