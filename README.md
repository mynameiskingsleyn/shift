# Project.
This project was built with symfony4 PHP framework.
#
    This project simulates the whole process involved with self checkout.
    ones total amount is realized.
    No need to know your math, just add money denomination e.g( $100=>3, $50=>2) etc
    The app calculates your sum using AJAX. and ones transaction is completed, it calculates the exact change in bills and or coins.
    It mimics a live cashier-register->reports when there is cash shortage(e.g $5 is short please add more)
    also reports when there is too much cash denomination e.g( too many $5 denominations in register) etc.

#   Currency
    1. This app acceps American currency, but have the potential to use other currencies
#   Technicality
    This project uses OOP pattern.
    It also demonstrates two main advance concepts.
      1. Service Oriented Architecture.(Abstract[WorldMoney] and concrete[USAMoney] )
      2. Repository pattern (AppMoneyRepository class).

#   Scalability
    Project was built with Scalability in mind. Project currently handles USA dollar and cents denomination pattern,
    but has the potential of handling other currencies denominations that do not fall within the same pattern.

    Now to handle other denomination patterns we only need to take two steps.
    1. Create a new service that extends our parent Service(WorldMoney) or child service USAMoney(if child has denominations).

    2. Create two associative arrays denom and bank. denom having (values of all denominations in descending order), bank having same
      value as denom but set to zero. Or you can simply add your money denominations and currency(bank) the database.


#   Testing
    PHPUnit testing was used in this project.

