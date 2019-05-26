# shift Pro.
This project was built with symfony4 PHP framework.
#
    This is a simple api end point which accepts two parameters total_cost and amount_provided.
    total_cost is the amount incurred on a single transaction, amount_provided is the exact amount paid
#   endpoint
    Sample endpoint is http://switch.test/cashierapi/calculatechange?total_cost=234.34&amount_provided=345.33
#   Technicality
    This project is demonstrates an OOP approach to programing
    It demonstrates two main advance concepts
      1. Service Oriented Architecture.
      2. Repository pattern.

#   Functionality
    #input Accepts amount provided at input amount_provided(in dolars and/or cents), total cost at param total_cost(in dolars and/or cents)
    #output Returns your change amount in Dolars and cents. Also provides the exact change by returning the count of each denomination of bills and/or coins. 
