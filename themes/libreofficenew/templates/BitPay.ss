<form id="makeDonation" action="https://bitpay.com/checkout?lang=<%t BitPay.CheckoutLocale "en_US" is "the locale used for the bitpay checkout" %>" method="post" onsubmit="return bp.validateMobileCheckoutForm($('#makeDonation'));">
<h4><%t BitPay.Header "You can donate Via Bitcoins" is "header about bitpay form" %></h4>
    <input name="action" type="hidden" value="checkout">
    <fieldset>
        <label for="bp_email"><%t BitPay.LabelEmail "Email:" is "the label for email-entrybox" %></label>
        <input id="bp_email" name="orderID" type="email" class="input input-xlarge" placeholder="<%t BitPay.Email "Email address (optional)" is "placeholder text for email-box" %>" maxlength=50><br/>
        <label for="bp_price">Bitcoins:</label>
        <input id="bp_price" name="price" type="number" class="noscroll" value="0.01" placeholder="Amount" min="0.01" step="0.01" style="width: 100px"  />
        <select name="currency" style="width: 100px" >
            <option value="USD">USD</option>
            <option value="BTC" selected="selected">BTC</option>
            <option value="EUR">EUR</option>
            <option value="GBP">GBP</option>
            <option value="AUD">AUD</option>
            <option value="BGN">BGN</option>
            <option value="BRL">BRL</option>
            <option value="CAD">CAD</option>
            <option value="CHF">CHF</option>
            <option value="CNY">CNY</option>
            <option value="CZK">CZK</option>
            <option value="DKK">DKK</option>
            <option value="HKD">HKD</option>
            <option value="HRK">HRK</option>
            <option value="HUF">HUF</option>
            <option value="IDR">IDR</option>
            <option value="ILS">ILS</option>
            <option value="INR">INR</option>
            <option value="JPY">JPY</option>
            <option value="KRW">KRW</option>
            <option value="LTL">LTL</option>
            <option value="LVL">LVL</option>
            <option value="MXN">MXN</option>
            <option value="MYR">MYR</option>
            <option value="NOK">NOK</option>
            <option value="NZD">NZD</option>
            <option value="PHP">PHP</option>
            <option value="PLN">PLN</option>
            <option value="RON">RON</option>
            <option value="RUB">RUB</option>
            <option value="SEK">SEK</option>
            <option value="SGD">SGD</option>
            <option value="THB">THB</option>
            <option value="TRY">TRY</option>
            <option value="ZAR">ZAR</option>
        </select>
        <p><%t BitPay.RefundDisclaimer "Due to their nature, donations via Bitcoins are usually anonymous, so any kind of refunds or donation confirmation is only possible on the sum we received by our payment provider, and only given you mention your e-mail address. If you don't consent to the aforementioned conditions, we kindly ask you to consider one of the other donation options outlined on this page." is "disclaimer that refunds are only possible when email was specified" %></p>
        <input type="hidden" name="data" value="Jb+jx1A9kjKx55zdgbHg7baJ4ow8Z31ljqFTsM5shdllv/sEF80HDr1+OAKOpkUxRz0ThtqWrUn7brG4eY3BYSv8+Cu7CYa1NEJjBFAyrBKwbKSToTPwAJdmXMXciVDcvBg+jgaAdY9EGsMd2tzeuvWF7B4b0oIRImCK6e4nRYZ4/TM3e7QydK7hYbbliiH8PiNFQHylg3o4DXFj3NCebZ9r8teHc6dbN0bOkbAWlLhoQTT5Iq/dGYSrbUgcq9vJGeDtKYMpIQF8c+WaFMXjVw==">
        <div style="margin: auto; width: 100%; text-align: left">
            <input name="submit" src="https://bitpay.com/img/donate-md.png" type="image" style="width: auto" alt="<%t BitPay.ButtonAltText "BitPay, the easy way to pay with bitcoins." is "alt text for Bitpay button" %>">
        </div>
    </fieldset>
</form>
