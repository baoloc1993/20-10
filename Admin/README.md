# Admin folder

Chứa các page hỗ trợ quản lí database cho admin
Phải nhập mật khẩu dưới dạng GET của PHP (address?pw=[PASSWORD]) - làm tạm cho nhanh :D
File security.php đảm nhận việc check password
Nếu password sai, điều hướng đến trang 404.html

femaleparticipant.php: quản lý database các bạn nữ đã tham gia
maleparticipant.php: quản lý database các osin đã trót dại đăng ký :v.
blacklist.php: quản lý database các email address không phải nữ (để filter bớt trong khâu đăng ký)
