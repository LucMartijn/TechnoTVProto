let Templates = ["slide-type-1", "slide-type-2", "slide-type-2", "slide-type-1"];
let slideNumber = 0;
let slideIdCounter = 0;
let frameLength = 0;
let Story = "";
let newsflashCreated = 1;




let wakeLock = null;

// Request a screen wake lock
async function requestWakeLock() {
    try {
        wakeLock = await navigator.wakeLock.request('screen');
            
    } catch (err) {
        console.error(`${err.name}, ${err.message}`);
    }
}

window.addEventListener('focus', requestWakeLock);

window.addEventListener('blur', () => {
    if (wakeLock !== null) {
        wakeLock.release();
        wakeLock = null;
    }
});
// Async function to handle the full flow
async function initializeSlideshow() {
    // Fetch news and wait for the response
    await getNews("Data/fetchNewsFlash.php");
    console.log(Story)
    for (const part of Story) {
        createNewsFlash(part); 
        slideIdCounter++;
    }


    await getNews("Data/fetchGallery.php");
    console.log(Story)
    for (const part of Story) {
      createGallery(part); 
      slideIdCounter++;
  }

  await getNews("Data/fetchStory.php");
  console.log(Story)
  for (const part of Story) {
    createStory(part); 
    slideIdCounter++;
}


    // After creating the slides, initialize the slideshow

    // Get the number of child elements (slides) in the container
    let frame = document.getElementById("index-slideshow-frame");
    frameLength = frame.childElementCount; // Starts at 0

    // Start the slideshow after all slides are created
    slideshow();
}

// Fetch news from the provided path and store the response in `Story`
async function getNews(path) {
    const response = await fetch([path]);
    Story = await response.json();
    console.log(Story);
}

// Function to create slides based on the news data
function createNewsFlash(part) {
    // Select a random slide template from the Templates array
    let randomSlide = Templates[Math.floor(Math.random() * Templates.length)];

    // Get the template and container
    const Template = document.getElementById("index-slide-1");
    const container = document.getElementById('index-slideshow-frame');
    const clone = Template.content.cloneNode(true);
    const clonedElement = clone.querySelector('section');

    // Set image source, title, and description
    clone.querySelector('img').src = part.flashimage1;
    if (part.flashimage2 === null) {
      clone.getElementById('template-image-2').style.display = "none";
    }else {
      clone.getElementById('template-image-2').src = part.flashimage2;
      console.log(part.flashimage2)
    }
    clone.querySelector('h1').textContent = part.title;
    clone.querySelector('article').textContent = part.flashdesc1;

    // Prepare the slide class and id
    clonedElement.classList.add("Slide", randomSlide);
    clonedElement.id = 'slideshowSlide-' + slideIdCounter;

    // Append the cloned element to the container
    container.appendChild(clone);
}



function createGallery(part) {

  let rotation = Math.random() * 10 - 5;
  // Get the template and container
  const Template = document.getElementById("index-slide-2");
  const container = document.getElementById('index-slideshow-frame');
  const clone = Template.content.cloneNode(true);
  const clonedElement = clone.querySelector('section');

  clone.getElementById("gallery-h1-1").textContent = part.title;

  // Set image source, title, and description
  clone.getElementById('gallery-image-1').src = part.image1_path;
  clone.getElementById('gallery-image-2').src = part.image2_path;
  clone.getElementById('gallery-image-3').src = part.image3_path;
  clone.getElementById('gallery-image-4').src = part.image4_path;
  clone.getElementById('gallery-image-5').src = part.image5_path;
  clone.getElementById('gallery-image-6').src = part.image6_path;
  clone.getElementById('gallery-image-7').src = part.image7_path;
  clone.getElementById('gallery-image-8').src = part.image8_path;
  clone.getElementById('gallery-image-9').src = part.image9_path;
  clone.getElementById('gallery-image-10').src = part.image10_path;

  rotation = Math.random() * 10 - 5;
  clone.getElementById('gallery-image-1').src = part.image1_path;
  rotation = Math.random() * 10 - 5;
  clone.getElementById('gallery-image-2').style.transform = 'rotate(' + rotation + 'deg)';
  rotation = Math.random() * 10 - 5;
  clone.getElementById('gallery-image-3').style.transform = 'rotate(' + rotation + 'deg)';
  rotation = Math.random() * 10 - 5;
  clone.getElementById('gallery-image-4').style.transform = 'rotate(' + rotation + 'deg)';
  rotation = Math.random() * 10 - 5;
  clone.getElementById('gallery-image-5').style.transform = 'rotate(' + rotation + 'deg)';
  rotation = Math.random() * 10 - 5;
  clone.getElementById('gallery-image-6').style.transform = 'rotate(' + rotation + 'deg)';
  rotation = Math.random() * 10 - 5;
  clone.getElementById('gallery-image-7').style.transform = 'rotate(' + rotation + 'deg)';
  rotation = Math.random() * 10 - 5;
  clone.getElementById('gallery-image-8').style.transform = 'rotate(' + rotation + 'deg)';
  rotation = Math.random() * 10 - 5;
  clone.getElementById('gallery-image-9').style.transform = 'rotate(' + rotation + 'deg)';
  rotation = Math.random() * 10 - 5;
  clone.getElementById('gallery-image-10').style.transform = 'rotate(' + rotation + 'deg)';

  // Prepare the slide class and id
  clonedElement.classList.add("Slide","Gallery");
  clonedElement.id = 'slideshowSlide-' + slideIdCounter;

  // Append the cloned element to the container
  container.appendChild(clone);
}



function createStory(part) {
  // Get the template and container
  const Template = document.getElementById("index-slide-3");
  const container = document.getElementById('index-slideshow-frame');
  const clone = Template.content.cloneNode(true);
  const clonedElement = clone.querySelector('section');

  clone.querySelector('h1').textContent = part.title;
  clone.getElementById("Story-article-1").textContent = part.storydesc1;
  clone.getElementById("Story-article-2").textContent = part.storydesc2;

  // Prepare the slide class and id
  clonedElement.classList.add("Slide");
  clonedElement.id = 'slideshowSlide-' + slideIdCounter;

  // Append the cloned element to the container
  container.appendChild(clone);
}
// Slideshow function
let previousSlide = -1; // Initialize with a value that doesn't match any valid slide index

function slideshow() {
    // Show the current slide
    document.getElementById("slideshowSlide-" + slideNumber).style.display = "grid";
    
    setTimeout(() => {
        console.log("slideshowSlide-" + slideNumber);
        document.getElementById("slideshowSlide-" + slideNumber).style.opacity = "1"; // Transition in
    }, 100);
    
    setTimeout(() => {
        document.getElementById("slideshowSlide-" + slideNumber).style.opacity = "0"; // Transition out
    }, 14250);//sets the opacity to 0 for the transition, set about 750 miliseconds before the item hides
    
    setTimeout(() => {
        document.getElementById("slideshowSlide-" + slideNumber).style.display = "none"; // Hide the item
        
        // Pick a new random slide number that's different from the previous one
        do {
            slideNumber = Math.floor(Math.random() * frameLength);
            console.log(frameLength)
        } while (slideNumber === previousSlide);

        // Store the current slide as the previous one
        previousSlide = slideNumber;

    }, 15000);//untill the item gets hidden

    setTimeout(slideshow, 15000);//Delay for every slide after
}



// Start the entire process
initializeSlideshow();




// TODO: Add some funny things with battery (↓ check link and functions below ↓)
// https://whatwebcando.today/battery-status.html





//Battery info, not using but might be fun to add?
/*navigator.getBattery().then((battery) => {
    function updateAllBatteryInfo() {
      updateChargeInfo();
      updateLevelInfo();
      updateChargingInfo();
      updateDischargingInfo();
    }
    updateAllBatteryInfo();
  
    battery.addEventListener("chargingchange", () => {
      updateChargeInfo();
    });
    function updateChargeInfo() {
      console.log(Battery charging? ${battery.charging ? "Yes" : "No"});
    }
  
    battery.addEventListener("levelchange", () => {
      updateLevelInfo();
    });
    function updateLevelInfo() {
      console.log(Battery level: ${battery.level * 100}%);
    }
  
    battery.addEventListener("chargingtimechange", () => {
      updateChargingInfo();
    });
    function updateChargingInfo() {
      console.log(Battery charging time: ${battery.chargingTime} seconds);
    }
  
    battery.addEventListener("dischargingtimechange", () => {
      updateDischargingInfo();
    });
    function updateDischargingInfo() {
      console.log(Battery discharging time: ${battery.dischargingTime} seconds);
    }
  });

*/