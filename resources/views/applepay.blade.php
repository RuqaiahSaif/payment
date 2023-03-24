<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Other Tags -->

  <!-- Moyasar Styles -->
  <link rel="stylesheet" href="https://cdn.moyasar.com/mpf/1.7.3/moyasar.css" />

  <!-- Moyasar Scripts -->
  <script src="https://polyfill.io/v3/polyfill.min.js?features=fetch"></script>
  <script src="https://cdn.moyasar.com/mpf/1.7.3/moyasar.js"></script>

  <!-- Download CSS and JS files in case you want to test it locally, but use CDN in production -->
</head>
<body>

<div class="mysr-form"></div>
<script>

Moyasar.init({
        element: '.mysr-form',
        // Amount in the smallest currency unit.
        // For example:
        // 10 SAR = 10 * 100 Halalas
        // 10 KWD = 10 * 1000 Fils
        // 10 JPY = 10 JPY (Japanese Yen does not have fractions)
        amount: 1000,
        currency: 'SAR',
        description: 'Coffee Order #1',
        publishable_api_key: 'pk_test_6y4BnV2BKn5C2BtEpEKmZhczVDQMRBTju1jrPpRB',
        callback_url: 'http://127.0.0.1:8000/api/callback',
        methods: ['applepay'],
        apple_pay: {
    country: 'SA',
    label: 'Awesome Cookie Store',
    validate_merchant_url: 'https://www.home.atlbha.com/.well-known/apple-developer-merchantid-domain-association',
  },
  on_completed: 'http://127.0.0.1:8000/api/callback',
});
</script>
</body>
</html>
