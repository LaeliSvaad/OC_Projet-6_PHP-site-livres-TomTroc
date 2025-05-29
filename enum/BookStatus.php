<?php
enum BookStatus : string
{
    case AVAILABLE = 'available';
    case NOT_AVAILABLE = 'not available';
    case RESERVED = 'reserved';
}