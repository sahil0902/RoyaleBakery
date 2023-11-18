# Save this as send_email.py
import smtplib
from email.mime.text import MIMEText
from email.mime.multipart import MIMEMultipart
import sys

def send_email(subject, body, to_email):
    from_email = "nr._.royalebakery@outlook.com"
    password = "admin@royalebakery123"

    msg = MIMEMultipart()
    msg["From"] = from_email
    msg["To"] = to_email
    msg["Subject"] = subject
    msg.attach(MIMEText(body, 'html'))

    try:
        server = smtplib.SMTP('smtp.live.com', 587)
        server.starttls()
        server.login(from_email, password)
        server.sendmail(from_email, to_email, msg.as_string())
        server.quit()

        return True
    except Exception as e:
        return str(e)

if __name__ == "__main__":
    if len(sys.argv) == 4:
        result = send_email(sys.argv[1], sys.argv[2], sys.argv[3])
        if result is True:
            print("Email sent successfully!")
        else:
            print(f"Error: {result}")
    else:
        print("Invalid number of arguments.")
