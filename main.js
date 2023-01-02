//Appena apro faccio partire lo stream

const begin = document.getElementById('start');
const end = document.getElementById('stop');


const config = 
{
  inputStream : {
    name : "Live",
    type : "LiveStream",
    target: document.querySelector('#test'),  // Or '#yourElement' (optional)
    constraints: {
      width: 1920,
      height: 1080,
    },
    facingMode : "environment"   
  },
  locator : {
    halfSample: false,
    patchSize: "small", // x-small, small, medium, large, x-large
    debug: {
      showCanvas: true,
      showPatches: true,
      showFoundPatches: true,
      showSkeleton: true,
      showLabels: true,
      showPatchLabels: true,
      showRemainingPatchLabels: true,
      boxFromPatches: {
        showTransformed: true,
        showTransformedBox: true,
        showBB: true
      }
    }
  },
  decoder : {
    readers : ["upc_reader"]
  },
  debug : true,
  debug: {
    drawBoundingBox: true,
    showFrequency: true,
    drawScanline: true,
    showPattern: true
  }
}

onOpen(config);

// Even listeners per iniziare e terminare lo stream.
begin.addEventListener("click", startStream)
end.addEventListener("click", stopStream)

Quagga.onDetected(function(data){
  const input = document.getElementById('input_barcode');
  console.log('letto')
  input.value = ''
  const result = data.codeResult.code
  input.value = result
});

// Funzione che lo inizializza se terminato
function startStream(){
  console.log("Stream iniziato")
  onOpen(config)
}

// Funzione per terminare lo stream
function stopStream(){
  console.log("Stream finito")
  Quagga.stop()
}


// Funzione che inizializza lo stream
function onOpen(config){
  Quagga.init(config, function(err) {
      if (err) {
          console.log(err);
          return
      }
      console.log("Initialization finished. Ready to start");
      Quagga.start();
  });
  
}

