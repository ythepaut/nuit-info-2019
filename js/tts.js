var synth = window.speechSynthesis;

var voices = synth.getVoices();
var voice_fr = null;

for (let i=0; i<voices.length; i++) {
    if (voices[i].lang.includes("fr")) {
        voice_fr = voices[i];
    }
    else if (voice_fr === null && voices[i].lang.includes("en")) {
        voice_fr = voices[i];
    }
}

if (speechSynthesis.onvoiceschanged !== undefined) {
  speechSynthesis.onvoiceschanged = voices;
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

    utterThis.voice = voice_fr;
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
