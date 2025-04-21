document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.querySelector('.menuToggle');
            const header = document.querySelector('header');
        
            // Tìm tất cả các mục sản phẩm
            const products = document.querySelectorAll('.navigation li');
        
            // Duyệt qua từng mục sản phẩm để thêm sự kiện khi click
            products.forEach(product => {
                const link = product.querySelector('a');
                const submenu = product.querySelector('.submenu');
        
                // Nếu mục sản phẩm có submenu
                if (submenu) {
                    // Thêm sự kiện click cho mục sản phẩm
                    product.addEventListener('click', function(e) {
                        e.preventDefault(); // Ngăn chặn hành động mặc định của thẻ a
                        submenu.classList.toggle('show');
                    });
                } else {
                    // Nếu mục sản phẩm không có submenu, thực hiện chuyển trang khi click
                    link.addEventListener('click', function(e) {
                        // Nếu mục có href (được gắn link), chuyển đến trang được chỉ định
                        if (this.getAttribute('href')) {
                            window.location.href = this.getAttribute('href');
                        }
                    });
                }
            });
        
            menuToggle.onclick = function() {
                // Mở hoặc đóng menu
                header.classList.toggle('open');
            }
        });



