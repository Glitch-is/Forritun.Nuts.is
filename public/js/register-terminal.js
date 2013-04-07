//Created by James Elías Sigurðarson 2013

jQuery(function($, undefined) {
// LOGIN
// The prompts, the validators, and the error messages
var prompts = [
  {
    title: 'nafn: ',
    field: 'name',
    validator: function(cmd){
      return /^[A-Za-zá-öÁ-Ö ]*$/.test(cmd);
    },
    errormsg: 'Nafn getur einungis innihaldið bókstafi eða bil',
    optional: false,
    password: false
  },
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
    title: 'símanúmer(valfrjálst): ',
    field: 'phone',
    validator: function(cmd){
      return /^(\+354[- ]?)?[\d]{3}[\s-]?[\d]{4}$/.test(cmd);
    },
    errormsg: 'Símanúmer eru venjulega á forminu XXX-XXXX',
    optional: true,
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
    submit: 'skrá í klúbb (j/n): ',
    url: '/register',
    type: 'POST',
    success: function(data, term)
    {
      if (data.success)
      {
        term.echo('Velkomin/n í forritunarklúbbinn!');
        return true;
      }
      else
      {
        term.echo("Nýskráning gekk ekki, reynið aftur síðar");
        return false;
      }
    },
    error: function(term)
    {
      term.echo("Nýskráning gekk ekki, reynið aftur síðar");
    },
    terminal: {
      height: 400,
      history: false,
      enabled: false,
      greetings: "Skráning í Forritunarklúbbinn"
    }
  };
  $('#terminal').formTerminal(term_data);
});
