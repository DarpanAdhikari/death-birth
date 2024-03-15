const decrementBtn = document.getElementById('decrement');
const incrementBtn = document.getElementById('increment');
const counterInput = document.getElementById('counter');
const options = document.getElementsByName('mariage_status');

if(counterInput && decrementBtn && incrementBtn){
    options.forEach((option,index)=>{
        option.addEventListener('click',()=>{
            if(index == 1 || index == 2){
                document.getElementById('child_count').classList.remove('hidden');
              incDec();
            }else{
                document.getElementById('child_count').classList.add('hidden');
            }
        });
    })
    
   function incDec(){
    decrementBtn.addEventListener('click', (e) => {
        e.preventDefault();
        if (parseInt(counterInput.value) > 0) {
            counterInput.value = parseInt(counterInput.value) - 1;
        }
    });
    
    incrementBtn.addEventListener('click', (e) => {
        e.preventDefault();
        counterInput.value = parseInt(counterInput.value) + 1;
    });
   }
}