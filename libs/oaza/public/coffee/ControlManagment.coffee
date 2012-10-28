class ControlManagment
  constructor: ()->
    elements = document.getElementsByClassName('widget manage');
#    for(i=0; i<elements.length; i++)
#      element = elements[i]
#      console.log(element);

    #console.log(elements);

loadOaza = ()->
  cm = new ControlManagment;

window.ControlManagment = ControlManagment
window.onload = loadOaza