let slider = document.getElementById("ada_slide_bar_autoplay_speed");
let value = document.getElementById("ada_slide_bar_autoplay_speed_value");

slider.addEventListener(
  "input",
  function () {
    value.innerHTML = slider.value / 1000 + " seconds";
  },
  false
);
