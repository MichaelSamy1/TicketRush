const API_KEY = 'ZXlKaGJHY2lPaUpJVXpVeE1pSXNJblI1Y0NJNklrcFhWQ0o5LmV5SmpiR0Z6Y3lJNklrMWxjbU5vWVc1MElpd2ljSEp2Wm1sc1pWOXdheUk2T1RjM01qUTJMQ0p1WVcxbElqb2lhVzVwZEdsaGJDSjkua2N1YmF0UThnbUpHZFJzRE00SlAzQ3hLTEJmMnBVeXk5ejVySDZsZjlYby1OaEdkZE1yQmZjSmFXZWp4Ync1dTF6dGJvZHQ4OFBtQzc2alJjcXRFaVE=';

document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const totalPrice = urlParams.get('total_price');

    if (totalPrice) {
        firstStep(parseFloat(totalPrice));
    }
});

async function firstStep(totalPrice) {
    try {
        const token = await getToken(API_KEY);

        if (token) {
            const orderId = await createOrder(token, totalPrice);

            if (orderId) {
                await getPaymentKey(token, orderId, totalPrice);
            }
        }
    } catch (error) {
        console.error('Error in first step:', error);
    }
}

async function getToken(apiKey) {
    try {
        const response = await fetch('https://accept.paymob.com/api/auth/tokens', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({api_key: apiKey})
        });

        const data = await response.json();
        return data.token;
    } catch (error) {
        throw new Error('Error fetching token: ' + error);
    }
}

async function createOrder(token, totalPrice) {
    try {
        const response = await fetch('https://accept.paymob.com/api/ecommerce/orders', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({
                auth_token: token,
                delivery_needed: "false",
                amount_cents: Math.round(totalPrice * 100), // Ensure this is in cents and rounded to avoid floating-point issues
                currency: "EGP",
                items: []
            })
        });

        const data = await response.json();
        return data.id;
    } catch (error) {
        throw new Error('Error creating order: ' + error);
    }
}

async function getPaymentKey(token, orderId, totalPrice) {
    try {
        const response = await fetch('https://accept.paymob.com/api/acceptance/payment_keys', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({
                auth_token: token,
                amount_cents: Math.round(totalPrice * 100), // Ensure this is in cents and rounded to avoid floating-point issues
                expiration: 3600,
                order_id: orderId,
                billing_data: {
                    // Your billing data here
                    apartment: "803",
                    email: "claudette09@exa.com",
                    floor: "42",
                    first_name: "Clifford",
                    street: "Ethan Land",
                    building: "8028",
                    phone_number: "+86(8)9135210487",
                    shipping_method: "PKG",
                    postal_code: "01898",
                    city: "Jaskolskiburgh",
                    country: "CR",
                    last_name: "Nicolas",
                    state: "Utah"
                },
                currency: "EGP",
                integration_id: 4578504 // Your integration ID here
            })
        });

        const data = await response.json();
        const paymentToken = data.token;

        if (paymentToken) {
            cardPayment(paymentToken);
        } else {
            throw new Error('Failed to get payment token');
        }
    } catch (error) {
        throw new Error('Error getting payment key: ' + error);
    }
}

function cardPayment(token) {
    const iframeURL = `https://accept.paymob.com/api/acceptance/iframes/847262?payment_token=${token}`;
    location.href = iframeURL;
}
