/**
 * AdminLTE Demo Menu
 * ------------------
 * You should not use this file in production.
 * This file is for demo purposes only.
 */
(function ($, AdminLTE) {

  "use strict";

  /**
   * List of all the available skins
   *
   * @type Array
   */
  var my_skins = [
    "skin-blue",
    "skin-black",
    "skin-red",
    "skin-yellow",
    "skin-purple",
    "skin-green",
    "skin-blue-light",
    "skin-black-light",
    "skin-red-light",
    "skin-yellow-light",
    "skin-purple-light",
    "skin-green-light"
  ];
  
  setup();
  
  /**
   * Toggles layout classes
   *
   * @param String cls the layout class to toggle
   * @returns void
   */
  function change_layout(cls) {
    $("body").toggleClass(cls);
	if(AdminLTE.layout)
	{
		AdminLTE.layout.fixSidebar();
	}
    //Fix the problem with right sidebar and layout boxed
    if (cls == "layout-boxed")
	{
		if(AdminLTE.controlSidebar)
		{	
		  AdminLTE.controlSidebar._fix($(".control-sidebar-bg"));
		}
		if ($('body').hasClass('fixed') && cls == 'fixed') {
		 if(AdminLTE.pushMenu)
		 {
			 AdminLTE.pushMenu.expandOnHover();
		 }		 
		 if(AdminLTE.layout)
		 {
			 AdminLTE.layout.activate();
		 }	   
		}
	}
	if(AdminLTE.controlSidebar)
	{
		AdminLTE.controlSidebar._fix($(".control-sidebar-bg"));
		AdminLTE.controlSidebar._fix($(".control-sidebar"));
	} 
    
  }

  /**
   * Replaces the old skin with the new skin
   * @param String cls the new skin class
   * @returns Boolean false to prevent link's default action
   */
  function change_skin(cls) {
    $.each(my_skins, function (i) {
      $("body").removeClass(my_skins[i]);
    });

    $("body").addClass(cls);
    store('skin', cls);
    return false;
  }

  /**
   * Store a new settings in the browser
   *
   * @param String name Name of the setting
   * @param String val Value of the setting
   * @returns void
   */
  function store(name, val) {
    if (typeof (Storage) !== "undefined") {
      localStorage.setItem(name, val);
    } else {
      window.alert('请使用新型浏览器正确查看此模板!');
    }
  }

  /**
   * Get a prestored setting
   *
   * @param String name Name of of the setting
   * @returns String The value of the setting | null
   */
  function get(name) {
    if (typeof (Storage) !== "undefined") {
      return localStorage.getItem(name);
    } else {
      window.alert('请使用新型浏览器正确查看此模板!');
    }
  }

  /**
   * Retrieve default settings and apply them to the template
   *
   * @returns void
   */
  function setup() {
    var tmp = get('skin');
    if (tmp && $.inArray(tmp, my_skins))
      change_skin(tmp);

    //Add the change skin listener
    $("[data-skin]").on('click', function (e) {
      if($(this).hasClass('knob'))
        return;
      e.preventDefault();
      change_skin($(this).data('skin'));
    });
	
    //Add the layout manager
    $("[data-layout]").on('click', function () {
      change_layout($(this).data('layout'));
    });

    $("[data-controlsidebar]").on('click', function () {
      change_layout($(this).data('controlsidebar'));
      var slide = !AdminLTE.options.controlSidebarOptions.slide;
      AdminLTE.options.controlSidebarOptions.slide = slide;
      if (!slide)
        $('.control-sidebar').removeClass('control-sidebar-open');
    });

    $("[data-sidebarskin='toggle']").on('click', function () {
      var sidebar = $(".control-sidebar");
      if (sidebar.hasClass("control-sidebar-dark")) {
        sidebar.removeClass("control-sidebar-dark")
        sidebar.addClass("control-sidebar-light")
      } else {
        sidebar.removeClass("control-sidebar-light")
        sidebar.addClass("control-sidebar-dark")
      }
    });
	
    $("[data-enable='expandOnHover']").on('click', function () {
      $(this).attr('disabled', false);
	  if(AdminLTE.pushMenu)
	  {
		 AdminLTE.pushMenu.expandOnHover();
	  }
      if (!$('body').hasClass('sidebar-collapse'))
	  {
		//$("[data-layout='sidebar-collapse']").click();
	  }
       
    });

    // Reset options
    if ($('body').hasClass('fixed')) {
      $("[data-layout='fixed']").attr('checked', 'checked');
    }
    if ($('body').hasClass('layout-boxed')) {
      $("[data-layout='layout-boxed']").attr('checked', 'checked');
    }
    if ($('body').hasClass('sidebar-collapse')) {
      $("[data-layout='sidebar-collapse']").attr('checked', 'checked');
    }
	
	//////////////////////////////////////////////////////////////////
	$("[data-skin]").on('readys', function (e) {
      if($(this).hasClass('knob'))
        return;
      e.preventDefault();
      change_skin($(this).data('skin'));
    });
	
	
	 $("[data-layout]").on('readys', function () {
      change_layout($(this).data('layout'));
    });

    $("[data-controlsidebar]").on('readys', function () {
      change_layout($(this).data('controlsidebar'));
      var slide = !AdminLTE.options.controlSidebarOptions.slide;
      AdminLTE.options.controlSidebarOptions.slide = slide;
      if (!slide)
        $('.control-sidebar').removeClass('control-sidebar-open');
    });

    $("[data-sidebarskin='toggle']").on('readys', function () {
      var sidebar = $(".control-sidebar");
      if (sidebar.hasClass("control-sidebar-dark")) {
        sidebar.removeClass("control-sidebar-dark")
        sidebar.addClass("control-sidebar-light")
      } else {
        sidebar.removeClass("control-sidebar-light")
        sidebar.addClass("control-sidebar-dark")
      }
    });
	
    $("[data-enable='expandOnHover']").on('readys', function () {
      $(this).attr('disabled', false);
	  if(AdminLTE.pushMenu)
	  {
		 AdminLTE.pushMenu.expandOnHover();
	  }
      if (!$('body').hasClass('sidebar-collapse'))
	  {
		//$("[data-layout='sidebar-collapse']").trigger("readys");
	  }
       
    });
	
	
  }
})(jQuery, $.AdminLTE);
