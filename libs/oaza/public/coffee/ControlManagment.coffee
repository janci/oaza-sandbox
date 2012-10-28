class ControlManagment
  constructor: (adapter, configuration={})->
    defaultCfg =
      'selector': '.widget.manage'

    cfg = defaultCfg

    adapter(cfg.selector).on(
      'mouseenter': ()->
        mnblock = adapter('<div class="manageblock"><a href="#" class="mandelete">d</a><a href="#" class="manedit">e</a></div>')
        adapter(this).prepend(mnblock);
        adapter(mnblock).fadeIn();

      'mouseleave': ()->
        adapter('.manageblock', this).fadeOut( ()->
          adapter(this).remove();
        )

    )

loadOaza = ()->
  cm = new ControlManagment(window.jQueryAdapter);

window.ControlManagment = ControlManagment
window.onload = loadOaza