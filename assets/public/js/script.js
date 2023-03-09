/**
 * 
 * @This is the dark mode maker 
 * 
 */
("use strict");
function darkModeMaker(darkMode) {
  // This is the dark mode creator
  var darkMode;
  if (localStorage.getItem('dark-mode')) {
    darkMode = localStorage.getItem('dark-mode');  
  } else {
    darkMode = 'light';  
  }
  localStorage.setItem('dark-mode', darkMode);

  if (localStorage.getItem('dark-mode') == 'dark') {
    $('body').addClass('dark');
    $('.dark-button').hide();
    $('.light-button').show();
  }

  $('.dark-button').on('click', function() {  
    $('.dark-button').hide();
    $('.light-button').show();
    $('body').addClass('dark');
    localStorage.setItem('dark-mode', 'dark');
  });
  
  $('.light-button').on('click', function() {  
    $('.light-button').hide();
    $('.dark-button').show();
    $('body').removeClass('dark');
    localStorage.setItem('dark-mode', 'light');   
  });
  // end
}

//all darkModE player
const darkModEPlayer = () => {
  let alldarkModECommon = document.querySelectorAll(".ldarkm_common_style");
  for (item of alldarkModECommon) {
    darkModeMaker(item);
  }
};

// editMode active or not
let ldarkmDarkModeEditModeObserver = (getEditMode) => {
  // elementor render observing
  const ldarkmDarkModeObserver = new MutationObserver((mutations) => {
    mutations.map((record) => {
      if (record.addedNodes.length) {
        record.addedNodes.forEach((singleItem) => {
          if (singleItem.nodeName == "DIV") {
            if (singleItem.querySelector(".ldarkm_common_style")) {
              let observedItem = singleItem.querySelector(".ldarkm_common_style");
              darkModeMaker(observedItem);
            }
          }
        });
      }
    });
  });

  ldarkmDarkModeObserver.observe(getEditMode, {
    subtree: true,
    childList: true,
  });
};
// edit mode checker
(() => {
  let ldarkmMyInterValId;
  if (
    document.querySelector(".elementor-edit-area") ||
    document.querySelector(".ldarkm_common_style")
  ) {
    darkModEPlayer();
  } else {
    ldarkmMyInterValId = setInterval(() => {
      let ldarkmElementorEditArea = document.querySelector(".elementor-edit-area");
      if (ldarkmElementorEditArea) {
        clearInterval(ldarkmMyInterValId);
        // play ===============
        ldarkmDarkModeEditModeObserver(ldarkmElementorEditArea);
      }
    }, 300);
  }
})()