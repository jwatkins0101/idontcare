# idontcare.exposed

GE Programmable Logic Controllers (PLCs) and similar IoT devices are designed to operate only in local area networks. When they are misconfigured and become visible on the Internet, they widen the attack surface of the customer's network.

This application retrieves a list of IPs that are running the `SRTP` protocol and identify as a General Electric device. It then attempts to identify the customer operating the device. We then retrieve WHOIS information, geolocation displayed interactively, and reverse DNS lookup.

These devices are vulnerable when exposed to the public internet. Our next step is to automate an email sent through the app to notify the ISP owning the IP address of the device. We also create targeted advertising campaigns to alert the device owners directly and educate them about the vulnerabilities in their current setup. These actions assist the device owner in reducing their attack surface.

All of the data is automatically generated. Therefore, it dramatically reduces the effort necessary to help device owners keep their networks and businesses safe from external threats, just as Thomas Edison said: "There's a way to do it better - find it."

##contributors
Jermaine Watkins
Cheng-Chung Lee
Matthew Grubbs
Kristian Snyder
Joseph Hirschfeld