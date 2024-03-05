package models

import "gorm.io/gorm"

type ApartmentUnit struct {
	gorm.Model
	ID         uint `gorm:"primaryKey"`
	UnitNumber string
	UnitType   string
	Number     uint
	UnitSize   string
	UnitRent   string
	Image      string
	PropertyID uint
	Property   Property `gorm:"foreignKey:PropertyID"`
}
