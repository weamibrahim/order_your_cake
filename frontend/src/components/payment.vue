<template>
  <div class="ground">
    <div class="d-flex justify-content-center ">
      <form @submit.prevent="handleSubmit" style="box-shadow: 5px 5px 5px 5px #c8c8c8; padding: 10px; width: 500px; ">
        <h4 class="text-center">Payment</h4>
        <!-- Form fields -->
        <label>Card Number</label>
        <input class="form-control mb-3"
          type="text"
          v-model="formData.cardNumber"
          placeholder="Card Number"
        />
        <label>Exp Month</label>
        <input class="form-control mb-3"
          type="text"
          v-model="formData.expMonth"
          placeholder="Exp Month"
        />
        <label>Exp Year</label>
        <input class="form-control mb-3"
          type="text"
          v-model="formData.expYear"
          placeholder="Exp Year"
        />
        <label>CVV</label>
        <input class="form-control mb-3"
          type="text"
          v-model="formData.cvv"
          placeholder="CVV"
        />
        <!-- Other form fields -->
        <div class="d-flex justify-content-center">
          <button type="submit" class="btn btn-info mb-3" :disabled="isLoading">
            {{ isLoading ? 'Processing...' : 'Pay' }}
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { ref } from 'vue';

export default {
    name:"PaymentApp",
  setup() {
    const formData = ref({
      cardNumber: '',
      expMonth: '',
      expYear: '',
      cvv: '',
    });

    const isLoading = ref(false);

    const handleSubmit = async () => {
  isLoading.value = true;

  try {
    alert('Your order is about to be delivered');
    // const response = await fetch('http://localhost:8000/api/stripe', {
    //   method: 'POST',
    //   headers: {
    //     'Content-Type': 'application/json',
    //   },
    //   body: JSON.stringify(formData.value),
    // });

    // if (response.ok) {
    //   const data = await response.json();
    //   alert('Your order is about to be delivered');
    //   console.log(data.message);
    //   window.location.href = 'home'; // Redirect to home page
    // } else {
    //   console.error('Failed to process payment');
    //   console.error(response.statusText); // Log the error status text
    //   // Handle error message or show a notification to the user
    // }
  } catch (error) {
    console.error('Fetch error:', error);
    // Handle error message or show a notification to the user
  }

  isLoading.value = false;
};



    return {
      formData,
      isLoading,
      handleSubmit,
    };
  },
};
</script>
<style scoped>
.ground{

    background-image: url("https://img.freepik.com/free-photo/top-view-cake-with-pastry-cream-chocolate-plate-purple-shawl-bowls-with-chocolate-berries-fork_140725-99865.jpg?size=626&ext=jpg&uid=R50739859&ga=GA1.1.1532466403.1676939380&semt=sph");
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;

}
form{
    margin-top: 50px ;
    margin-bottom: 50px;
}
</style>
