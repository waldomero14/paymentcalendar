#Payment Calendar
The Burroughs test.

##Installing
Execute the `config.sh` file by running `bash config.sh`. This will install the composer dependencies and tools with the no-dev configuration.

##Running
Execute the `payment-calendar.sh` file by running `bash payment-calendar.sh`. This command will start the PHP application.

The application has some default configurations, for example, it will export a csv file with the payment dates starting in the current month and just for 12 months later. You can change that in the first step of the bash running.

The generated file is located in the `/export` folder using the filename you entered in the last step of the bash.

##Code
The starting point of the application is the `init.php` file. This file contains the console commands and calls the `PaymentManager` class whom creates an instance of the selected `PaymentCalendar` implementation (csv by default).

The logical components of the application are located in the `src` folder.

The idea was using a very simple implementation of the **Strategy** design pattern.