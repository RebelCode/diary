# Diary

[![Build Status](https://travis-ci.org/RebelCodecom/diary.svg?branch=task%2Fapi-refactoring_1)](https://travis-ci.org/RebelCodecom/diary)
[![Code Climate](https://codeclimate.com/github/RebelCodecom/diary/badges/gpa.svg)](https://codeclimate.com/github/RebelCodecom/diary)

A lightweight and generic PHP bookings library.

## Introduction

Diary is a lightweight and generic PHP bookings library that aims to provide a solid foundation for managing bookings at a storage-level.

The main API of Diary is composed of CRUD operations:

```
$diary->get($query);
$diary->insert($booking);
$diary->update($booking->getChanges());
$diary->delete($query);
```

Through the use of storage abstraction, the library is independent of any storage medium and query mechanisms, meaning you can use a storage adapter of your choice or create your own.

To extend the classes in the library, check out the [`rebelcode/diary-interface`][] package repository where we keep the interfaces for the API.
These interfaces allow interoperability between implementations. An example of this within Diary is the [`DateTime`][] class, which implements its [interface counterpart][2] and extends a class from the [`Carbon`] library.

## Requirements:

* **PHP**: 5.3+

## Installation

If you're using composer:

```
composer require rebelcode/diary
```

If you're not using composer, [then why not?][1]

[1]: http://blog.jgrossi.com/2013/why-you-should-use-composer-and-how-to-start-using-it/
[2]: https://github.com/RebelCodecom/diary-interface/blob/release/0.3/src/DateTime/DateTimeInterface.php
[`rebelcode/diary-interface`]: https://github.com/RebelCodecom/diary-interface
[`Carbon`]: http://carbon.nesbot.com/docs/
[`DateTime`]: https://github.com/RebelCodecom/diary/blob/task/api-refactoring_1/src/DateTime/DateTime.php
