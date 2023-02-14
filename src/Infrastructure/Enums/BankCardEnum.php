<?php
 namespace Infrastructure\Enums;

 enum BankCardEnum:int {
     case VISA = 0;
     case MASTER = 1;
     case MIR = 2;
     case ARCA = 3;
 }