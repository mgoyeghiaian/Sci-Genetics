function change(){
    usd = document.getElementById('amount').value;
    rate = document.getElementById('rate').value;
    // aed = document.getElementById('amountaed').value;

    result = usd * rate;
    document.getElementById('amountaed').value = result;
}

function change2(x){
    
    usd = document.getElementById('amount').value;
    usd2 = parseInt(usd) + parseInt(x);
    // aed = document.getElementById('amountaed').value;
    rate = document.getElementById('rate').value;
    // alert(rate);
    result = parseInt(usd2) * parseFloat(rate);
    // alert(result);
    document.getElementById('amountaed').value = result.toFixed(2);
}

// Function to generate a random string of specified length
function generateRandomString(length) {
    let result = '';
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
  
    for (let i = 0; i < length; i++) {
      const randomIndex = Math.floor(Math.random() * characters.length);
      result += characters.charAt(randomIndex);
    }
  
    return result;
  }
  
  // Function to generate a unique 8-character password
  function generateUniquePassword() {
    let password;
    const passwords = new Set();
  
    do {
      password = generateRandomString(8);
    } while (passwords.has(password));
  
    passwords.add(password);
    // return password;
    document.getElementById('gpas').value = password;
  }