# Shift Pro.
This project was built with symfony4 PHP framework.
#
    This is a simple api end point which accepts two parameters total_cost and amount_provided.
    total_cost is the amount incurred on a single transaction, amount_provided is the exact amount paid
#   endpoint
    Sample endpoint is http://switch.test/api/checkout?total_cost=234.34&amount_provided=340.35
    Sample output => {"error":0,"status":201,"balance":"$106.01","change":{"Hundred":1,"Five":1,"One":1,"Penny":1}}

#   Currency
    App will return error if input value does not meet the following specs.
    1. Not a number.
    2. Contains any special characters other than '.' or url friendly Characters(Note only amount before such special character would
        be processed).
    3. Input can only have 0 to 2 decimal places number

#   Technicality
    This project demonstrates an OOP approach of programing
    It also demonstrates two main advance concepts. TDD Pattern was not used.
      1. Service Oriented Architecture.
      2. Repository pattern.

#   Functionality
    #input Accepts amount provided at input amount_provided(in dolars and/or cents), total cost at param total_cost(in dolars and/or cents)
    #output Returns your change amount in Dolars and cents. Also provides the exact change by returning the count of each denomination of bills and/or coins.
    all returns are in JSON format.

#   PHPUnit Testing
    This project has implemented some unit testing.
