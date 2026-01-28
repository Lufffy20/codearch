var at = document.documentElement.getAttribute("data-layout");
if ((at = "vertical")) {

  // ----------------------------------------
  // Active 2 file at same time 
  // ----------------------------------------

  var currentNewURL =
    window.location != window.parent.location
      ? document.referrer
      : document.location.href;

  var current_link = document.getElementById("get-url");
  // Only modify the href if it's pointing to static HTML files, not dynamic routes
  if (current_link) {
    var originalHref = current_link.getAttribute("data-original-href") || current_link.getAttribute("href");

    // Store the original href to preserve it
    if (!current_link.hasAttribute("data-original-href")) {
      current_link.setAttribute("data-original-href", current_link.getAttribute("href"));
    }

    // Only change href if it's pointing to static HTML files, not Yii2 routes
    if (originalHref.includes("/main/index.html")) {
      if (currentNewURL.includes("/main/index.html")) {
        current_link.setAttribute("href", "../main/index.html");
      } else {
        current_link.setAttribute("href", "./index.html");
      }
    } else if (originalHref.includes("/index.html")) {
      if (currentNewURL.includes("/index.html")) {
        current_link.setAttribute("href", "./index.html");
      } else {
        current_link.setAttribute("href", "./");
      }
    } else {
      // For dynamic routes (like Yii2 routes), preserve the original href
      current_link.setAttribute("href", originalHref);
    }
  }
  // end

  function findMatchingElement() {
    var currentUrl = window.location.href;
    var anchors = document.querySelectorAll("#sidebarnav a");
    for (var i = 0; i < anchors.length; i++) {
      if (anchors[i].href === currentUrl) {
        return anchors[i];
      }
    }

    return null; // Return null if no matching element is found
  }
  var elements = findMatchingElement();

  // Do something with the matching element
  if (elements) {
    elements.classList.add("active");
  }

  document
    .querySelectorAll("ul#sidebarnav ul li a.active")
    .forEach(function (link) {
      link.closest("ul").classList.add("in");
      link.closest("ul").parentElement.classList.add("selected");
    });

  document.querySelectorAll("#sidebarnav li").forEach(function (li) {
    const isActive = li.classList.contains("selected");
    if (isActive) {
      const anchor = li.querySelector("a");
      if (anchor) {
        anchor.classList.add("active");
      }
    }
  });
  document.querySelectorAll("#sidebarnav a").forEach(function (link) {
    link.addEventListener("click", function (e) {
      const isActive = this.classList.contains("active");
      const parentUl = this.closest("ul");
      if (!isActive) {
        // hide any open menus and remove all other classes
        parentUl.querySelectorAll("ul").forEach(function (submenu) {
          submenu.classList.remove("in");
        });
        parentUl.querySelectorAll("a").forEach(function (navLink) {
          navLink.classList.remove("active");
        });

        // open our new menu and add the open class
        const submenu = this.nextElementSibling;
        if (submenu) {
          submenu.classList.add("in");
        }

        this.classList.add("active");
      } else {
        this.classList.remove("active");
        parentUl.classList.remove("active");
        const submenu = this.nextElementSibling;
        if (submenu) {
          submenu.classList.remove("in");
        }
      }
    });
  });
}
if ((at = "horizontal")) {
  function findMatchingElement() {
    var currentUrl = window.location.href;
    var anchors = document.querySelectorAll("#sidebarnavh ul#sidebarnav a");
    for (var i = 0; i < anchors.length; i++) {
      if (anchors[i].href === currentUrl) {
        return anchors[i];
      }
    }

    return null; // Return null if no matching element is found
  }
  var elements = findMatchingElement();

  if (elements) {
    elements.classList.add("active");
  }
  document
    .querySelectorAll("#sidebarnavh ul#sidebarnav a.active")
    .forEach(function (link) {
      link.closest("a").parentElement.classList.add("selected");
      link.closest("ul").parentElement.classList.add("selected");
    });
}
