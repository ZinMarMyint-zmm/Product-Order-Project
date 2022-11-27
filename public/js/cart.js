 $(document).ready(function() {

            //when + button click
            $('.btn-plus').click(function() {
                $parentNode = $(this).parents("tr");
                $price = Number($parentNode.find('#price').text().replace("Kyats", ""));
                $qty = Number($parentNode.find('#qty').val());
                $total = $price * $qty;
                $parentNode.find('#total').html(`${$total} Kyats`)

                summaryCalculation();

            })

            //when - button click
            $('.btn-minus').click(function() {
                $parentNode = $(this).parents("tr");
                $price = Number($parentNode.find('#price').text().replace("Kyats", ""));
                $qty = Number($parentNode.find('#qty').val());
                $total = $price * $qty;
                $parentNode.find('#total').html(`${$total} Kyats`)

                if ($qty == 0) {
                    $(".btn-minus").attr("disabled");
                }

                summaryCalculation();
            })





            //calculate final price
            function summaryCalculation() {
                $totalPrice = 0;
                $('#dataTable tbody tr').each(function(index, row) {
                    $totalPrice += Number($(row).find('#total').text().replace("Kyats", ""));
                });

                $('#subTotalPrice').html(`${$totalPrice} Kyats`);
                $('#finalPrice').html(`${$totalPrice+3000} Kyats`);
            }
        })
