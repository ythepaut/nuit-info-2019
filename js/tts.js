var synth = window.speechSynthesis;

var voices = [];

function populateVoiceList() {
  voices = synth.getVoices().sort(function (a, b) {
      const aname = a.name.toUpperCase(), bname = b.name.toUpperCase();
      if ( aname < bname ) return -1;
      else if ( aname == bname ) return 0;
      else return +1;
  });
}

populateVoiceList();

if (speechSynthesis.onvoiceschanged !== undefined) {
  speechSynthesis.onvoiceschanged = populateVoiceList;
}

function speak(txt) {
    if (synth.speaking) {
        synth.cancel();
    }
    if (txt !== '') {
    var utterThis = new SpeechSynthesisUtterance(txt);
    utterThis.onend = function (event) {
        //console.log('SpeechSynthesisUtterance.onend');
    }
    utterThis.onerror = function (event) {
        console.error('Erreur TTS');
    }

    var n = 0;

    for (let i=0; i<voices.length; i++) {
        if (voices[i].lang.includes("fr")) {
            n = i;
        }
    }

    utterThis.voice = voices[n];
    utterThis.pitch = 1;
    utterThis.rate = 1;
    synth.speak(utterThis);
  }
}

function speakGeneral() {
    var txt = document.querySelector('.txt').value;

    speak(txt);
}

var body = document.querySelector("html");

var last_move = new Date().getTime();

body.addEventListener('mousemove', e => {
    last_move = new Date().getTime();
    setTimeout(function() {
        if (new Date().getTime() - last_move > 1000) {
            var elements = document.querySelectorAll(':hover');

            for (let i=0; i<elements.length; i++) {
                var nodeType = elements[i].nodeName.toLowerCase();
                var allNodeTypes = ["p", "h1", "h2", "h3", "h4", "h5", "h6", "label"];

                if (allNodeTypes.includes(nodeType)) {
                    console.log(nodeType);
                    speak(elements[i].innerHTML);
                }
            }

            last_move = new Date().getTime();
        }
    }, 1100);
});